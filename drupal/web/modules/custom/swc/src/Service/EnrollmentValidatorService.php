<?php

namespace Drupal\swc\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Service for validating challenge enrollments.
 */
class EnrollmentValidatorService {

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
   * Check if athlete can enroll in a challenge.
   *
   * @param \Drupal\user\UserInterface $athlete
   *   The athlete user.
   * @param \Drupal\Core\Entity\EntityInterface $challenge
   *   The challenge entity.
   *
   * @return array
   *   Array with 'allowed' boolean and 'reason' string if not allowed.
   */
  public function validateEnrollment($athlete, $challenge) {
    // Check for duplicate active enrollment
    $existing = $this->findActiveEnrollment($athlete, $challenge);
    if ($existing) {
      return [
        'allowed' => FALSE,
        'reason' => 'You are already enrolled in this challenge.',
      ];
    }

    return ['allowed' => TRUE];
  }

  /**
   * Find existing active enrollment for athlete in challenge.
   *
   * @param \Drupal\user\UserInterface $athlete
   *   The athlete user.
   * @param \Drupal\Core\Entity\EntityInterface $challenge
   *   The challenge entity.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The enrollment if found, NULL otherwise.
   */
  public function findActiveEnrollment($athlete, $challenge) {
    // Query implementation pending when enrollment entity is created
    return NULL;
  }

}
