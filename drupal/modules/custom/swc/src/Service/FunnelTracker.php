<?php
namespace Drupal\swc\Service;
use Drupal\user\UserInterface;

class FunnelTracker {
  public function logEvent($event_type, UserInterface $user, array $context = []) {
    $event_data = [
      'event_type' => $event_type,
      'user_id' => $user->id(),
      'timestamp' => time(),
      'context' => $context,
    ];
    \Drupal::logger('swc_funnel')->info(
      'Funnel event: @event for @user',
      [
        '@event' => $event_type,
        '@user' => $user->getDisplayName(),
      ]
    );
  }
  
  public function enrollmentJoined(UserInterface $athlete, $challenge_id) {
    $this->logEvent('enrollment_joined', $athlete, ['challenge_id' => $challenge_id]);
  }
  
  public function workoutCompleted(UserInterface $athlete, $workout_id) {
    $this->logEvent('workout_completed', $athlete, ['workout_id' => $workout_id]);
  }
  
  public function videoSubmitted(UserInterface $athlete, $video_submission_id) {
    $this->logEvent('video_submitted', $athlete, ['video_submission_id' => $video_submission_id]);
  }
  
  public function checkInSubmitted(UserInterface $athlete, $check_in_id) {
    $this->logEvent('check_in_submitted', $athlete, ['check_in_id' => $check_in_id]);
  }
  
  public function coachingRelationshipInitiated(UserInterface $athlete, $coaching_relationship_id) {
    $this->logEvent('coaching_initiated', $athlete, ['coaching_relationship_id' => $coaching_relationship_id]);
  }
  
  public function coachingRelationshipActive(UserInterface $athlete, $coaching_relationship_id) {
    $this->logEvent('coaching_active', $athlete, ['coaching_relationship_id' => $coaching_relationship_id]);
  }
}
