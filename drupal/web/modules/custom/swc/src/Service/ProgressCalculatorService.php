<?php

namespace Drupal\swc\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Service for calculating athlete progress metrics.
 */
class ProgressCalculatorService {

  /**
   * Entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected EntityTypeManagerInterface $entityTypeManager;

  /**
   * Logger service.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected LoggerInterface $logger;

  /**
   * Constructor.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, LoggerInterface $logger) {
    $this->entityTypeManager = $entity_type_manager;
    $this->logger = $logger;
  }

  /**
   * Calculate progress metrics for a challenge enrollment.
   *
   * @param \Drupal\Core\Entity\EntityInterface $enrollment
   *   The challenge enrollment entity.
   *
   * @return array
   *   Array of progress metrics.
   */
  public function calculateEnrollmentProgress($enrollment) {
    return [
      'workouts_completed' => 0,
      'completion_percentage' => 0,
      'current_streak' => 0,
      'total_sessions' => 0,
    ];
  }

  /**
   * Calculate estimated 1RM based on workout history.
   *
   * @param \Drupal\user\UserInterface $user
   *   The athlete user.
   *
   * @return int|null
   *   Estimated 1RM in pounds, or NULL if insufficient data.
   */
  public function calculateEstimatedOneRepMax($user) {
    return NULL;
  }

}
