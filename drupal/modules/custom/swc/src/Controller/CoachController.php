<?php
namespace Drupal\swc\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class CoachController extends ControllerBase {

  public function dashboard(UserInterface $user = NULL) {
    $current_user = \Drupal::currentUser();
    $coach = $user ?? $this->entityTypeManager()->getStorage('user')->load($current_user->id());

    if (!$coach->hasRole('coach')) {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }

    $progressService = \Drupal::service('swc.progress_service');

    $build = [
      '#theme' => 'coach_dashboard',
      '#coach' => $coach,
      '#welcome_message' => $this->t('Coach Dashboard'),
    ];

    $pending_videos = $progressService->getPendingVideoReviews($coach);
    $pending_check_ins = $progressService->getPendingCheckInReviews($coach);

    $build['#needs_attention'] = [
      'pending_videos' => count($pending_videos),
      'pending_check_ins' => count($pending_check_ins),
    ];

    $build['#pending_videos'] = array_slice($pending_videos, 0, 5);
    $build['#pending_check_ins'] = array_slice($pending_check_ins, 0, 5);

    $athletes = $progressService->getCoachAthletes($coach);
    $build['#active_athletes'] = $athletes;

    $coaching_relationships = $this->entityTypeManager()->getStorage('coaching_relationship')
      ->getQuery()
      ->condition('coach', $coach->id())
      ->condition('status', 'active')
      ->sort('start_date', 'DESC')
      ->range(0, 10)
      ->execute();

    $relationships = $this->entityTypeManager()->getStorage('coaching_relationship')
      ->loadMultiple($coaching_relationships);

    $build['#active_relationships'] = $relationships;

    return $build;
  }
}
