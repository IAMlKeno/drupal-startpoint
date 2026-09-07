<?php

namespace Drupal\swc\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access control handler for challenge enrollment entities.
 */
class ChallengeEnrollmentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    // Admins have full access.
    if ($account->hasRole('administrator')) {
      return AccessResult::allowed();
    }

    switch ($operation) {
      case 'view':
        // Athlete can view own enrollment.
        if ($entity->getAthlete()->id() == $account->id()) {
          return AccessResult::allowed();
        }
        // Coaches can view athlete enrollments (access check pending).
        if ($account->hasRole('coach')) {
          return AccessResult::allowed();
        }
        return AccessResult::forbidden();

      case 'update':
        // Only admins can update enrollments.
        return AccessResult::forbidden();

      case 'delete':
        // Only admins can delete enrollments.
        return AccessResult::forbidden();

      default:
        return AccessResult::neutral();
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    // Only admins can create enrollments.
    return AccessResult::allowedIf($account->hasRole('administrator'));
  }

}
