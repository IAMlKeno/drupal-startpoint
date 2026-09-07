<?php

namespace Drupal\swc\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Psr\Log\LoggerInterface;

/**
 * Service for checking entity access permissions.
 */
class PermissionCheckerService {

  /**
   * Current user.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected AccountProxyInterface $currentUser;

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
  public function __construct(AccountProxyInterface $current_user, EntityTypeManagerInterface $entity_type_manager, LoggerInterface $logger) {
    $this->currentUser = $current_user;
    $this->entityTypeManager = $entity_type_manager;
    $this->logger = $logger;
  }

  /**
   * Check if current user can access an athlete's data.
   *
   * @param \Drupal\user\UserInterface $athlete
   *   The athlete user.
   *
   * @return bool
   *   TRUE if access is allowed, FALSE otherwise.
   */
  public function canAccessAthleteData($athlete) {
    // Athlete can access own data
    if ($this->currentUser->id() == $athlete->id()) {
      return TRUE;
    }

    // Coaches can access assigned athletes
    if ($this->currentUser->hasRole('coach')) {
      // Check if coach is assigned to athlete (implementation pending)
      return TRUE;
    }

    // Admins have full access
    if ($this->currentUser->hasRole('administrator')) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Check if current user can edit an athlete's data.
   *
   * @param \Drupal\user\UserInterface $athlete
   *   The athlete user.
   *
   * @return bool
   *   TRUE if edit is allowed, FALSE otherwise.
   */
  public function canEditAthleteData($athlete) {
    // Only athlete can edit own data
    if ($this->currentUser->id() == $athlete->id()) {
      return TRUE;
    }

    // Admins can edit
    if ($this->currentUser->hasRole('administrator')) {
      return TRUE;
    }

    return FALSE;
  }

}
