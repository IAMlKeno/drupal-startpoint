<?php
namespace Drupal\swc\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Symfony\Component\HttpFoundation\Request;
use Drupal\user\UserInterface;

class AthleteController extends ControllerBase {

  public function dashboard(UserInterface $user = NULL) {
    $current_user = \Drupal::currentUser();
    $user = $user ?? $this->entityTypeManager()->getStorage('user')->load($current_user->id());

    $progressService = \Drupal::service('swc.progress_service');

    $build = [
      '#theme' => 'athlete_dashboard',
      '#user' => $user,
      '#welcome_message' => $this->t('Welcome back, @name!', ['@name' => $user->getDisplayName()]),
    ];

    $enrollments = $this->entityTypeManager()->getStorage('challenge_enrollment')
      ->getQuery()
      ->condition('athlete', $user->id())
      ->condition('status', 'active')
      ->execute();

    if ($enrollments) {
      $enrollment_id = reset($enrollments);
      $enrollment = $this->entityTypeManager()->getStorage('challenge_enrollment')
        ->load($enrollment_id);

      $challenge = $enrollment->getChallenge();
      $metrics = $progressService->getAthleteMetrics($user, $enrollment_id);

      $build['#challenge'] = $challenge;
      $build['#challenge_progress'] = [
        'current' => $metrics['workouts_completed'],
        'total' => $metrics['total_sessions'],
        'percentage' => $metrics['completion_percentage'],
      ];

      $build['#today_workout'] = $progressService->getTodayWorkout($user, $enrollment_id);
      $build['#metrics'] = $metrics;
    }

    $build['#recent_check_ins'] = $progressService->getRecentCheckIns($user, 3);
    $build['#pending_feedback'] = $progressService->getPendingCoachFeedback($user);

    $coaching_relationships = $this->entityTypeManager()->getStorage('coaching_relationship')
      ->getQuery()
      ->condition('athlete', $user->id())
      ->condition('status', 'active')
      ->execute();

    if ($coaching_relationships) {
      $build['#has_coach'] = TRUE;
      $relationship_id = reset($coaching_relationships);
      $relationship = $this->entityTypeManager()->getStorage('coaching_relationship')
        ->load($relationship_id);
      $build['#coach'] = $relationship->getCoach();
    } else {
      $build['#has_coach'] = FALSE;
      $build['#coaching_cta'] = $this->t('Join a coached program to accelerate your progress');
    }

    return $build;
  }
}
