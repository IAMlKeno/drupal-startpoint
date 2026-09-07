<?php
namespace Drupal\swc\Service;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

class ProgressService {
  protected $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  public function getAthleteMetrics(UserInterface $athlete, $challenge_enrollment_id = NULL) {
    $metrics = [
      'workouts_completed' => 0,
      'total_sessions' => 0,
      'completion_percentage' => 0,
      'current_streak' => 0,
      'estimated_1rm' => NULL,
      'training_volume' => 0,
    ];

    $query = $this->entityTypeManager->getStorage('workout_session')
      ->getQuery()
      ->condition('athlete', $athlete->id());

    if ($challenge_enrollment_id) {
      $enrollment = $this->entityTypeManager->getStorage('challenge_enrollment')
        ->load($challenge_enrollment_id);
      if ($enrollment) {
        $challenge = $enrollment->getChallenge();
        $query->condition('created', $challenge->get('field_start_date')->value, '>=')
              ->condition('created', $challenge->get('field_end_date')->value, '<=');
      }
    }

    $session_ids = $query->execute();
    $metrics['total_sessions'] = count($session_ids);

    if ($session_ids) {
      $sessions = $this->entityTypeManager->getStorage('workout_session')
        ->loadMultiple($session_ids);

      foreach ($sessions as $session) {
        if ($session->isCompleted()) {
          $metrics['workouts_completed']++;
        }
        if ($session->get('notes')->value) {
          $metrics['training_volume']++;
        }
      }

      if ($metrics['total_sessions'] > 0) {
        $metrics['completion_percentage'] = round(
          ($metrics['workouts_completed'] / $metrics['total_sessions']) * 100
        );
      }

      $metrics['current_streak'] = $this->calculateStreak($sessions);
      $metrics['estimated_1rm'] = $athlete->get('field_squat_goal')->value ?? NULL;
    }

    return $metrics;
  }

  public function getRecentCheckIns(UserInterface $athlete, $limit = 5) {
    $query = $this->entityTypeManager->getStorage('check_in')
      ->getQuery()
      ->condition('athlete', $athlete->id())
      ->sort('created', 'DESC')
      ->range(0, $limit);

    $check_in_ids = $query->execute();
    return $this->entityTypeManager->getStorage('check_in')
      ->loadMultiple($check_in_ids);
  }

  public function getPendingCoachFeedback(UserInterface $athlete) {
    $query = $this->entityTypeManager->getStorage('video_submission')
      ->getQuery()
      ->condition('athlete', $athlete->id())
      ->condition('review_status', 'reviewed');

    $video_ids = $query->execute();
    return $this->entityTypeManager->getStorage('video_submission')
      ->loadMultiple($video_ids);
  }

  public function getTodayWorkout(UserInterface $athlete, $challenge_enrollment_id = NULL) {
    $today = date('Y-m-d');

    $query = $this->entityTypeManager->getStorage('workout_session')
      ->getQuery()
      ->condition('athlete', $athlete->id())
      ->condition('session_date', $today . 'T00:00:00', '>=')
      ->condition('session_date', $today . 'T23:59:59', '<=');

    $session_ids = $query->execute();
    if ($session_ids) {
      $session = $this->entityTypeManager->getStorage('workout_session')
        ->load(reset($session_ids));
      return $session->getWorkout();
    }
    return NULL;
  }

  private function calculateStreak(array $sessions) {
    if (empty($sessions)) return 0;

    $sessions = array_values($sessions);
    usort($sessions, function($a, $b) {
      return strtotime($b->get('session_date')->value) - 
             strtotime($a->get('session_date')->value);
    });

    $streak = 0;
    $today = new \DateTime();

    foreach ($sessions as $session) {
      if (!$session->isCompleted()) continue;

      $session_date = new \DateTime($session->get('session_date')->value);
      $diff = $today->diff($session_date)->days;

      if ($diff <= $streak + 1) {
        $streak++;
      } else {
        break;
      }
    }

    return $streak;
  }

  public function getCoachAthletes(UserInterface $coach) {
    $query = $this->entityTypeManager->getStorage('coaching_relationship')
      ->getQuery()
      ->condition('coach', $coach->id())
      ->condition('status', 'active');

    $relationship_ids = $query->execute();
    $relationships = $this->entityTypeManager->getStorage('coaching_relationship')
      ->loadMultiple($relationship_ids);

    $athletes = [];
    foreach ($relationships as $relationship) {
      $athletes[$relationship->getAthlete()->id()] = $relationship->getAthlete();
    }
    return $athletes;
  }

  public function getPendingVideoReviews(UserInterface $coach) {
    $athletes = $this->getCoachAthletes($coach);
    $athlete_ids = array_keys($athletes);

    if (empty($athlete_ids)) return [];

    $query = $this->entityTypeManager->getStorage('video_submission')
      ->getQuery()
      ->condition('athlete', $athlete_ids, 'IN')
      ->condition('review_status', 'pending')
      ->sort('submitted_date', 'DESC');

    $video_ids = $query->execute();
    return $this->entityTypeManager->getStorage('video_submission')
      ->loadMultiple($video_ids);
  }

  public function getPendingCheckInReviews(UserInterface $coach) {
    $athletes = $this->getCoachAthletes($coach);
    $athlete_ids = array_keys($athletes);

    if (empty($athlete_ids)) return [];

    $query = $this->entityTypeManager->getStorage('check_in')
      ->getQuery()
      ->condition('athlete', $athlete_ids, 'IN')
      ->condition('review_status', ['pending', 'needs_followup'], 'IN')
      ->sort('created', 'DESC');

    $check_in_ids = $query->execute();
    return $this->entityTypeManager->getStorage('check_in')
      ->loadMultiple($check_in_ids);
  }
}
