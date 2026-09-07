<?php

namespace Drupal\swc\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Access control handler for workout session entities.
 */
class WorkoutSessionAccessControlHandler extends EntityAccessControlHandler {

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
        // Athlete can view own sessions.
        if ($entity->getAthlete()->id() == $account->id()) {
          return AccessResult::allowed();
        }
        // Coaches can view assigned athlete sessions.
        if ($account->hasRole('coach')) {
          return AccessResult::allowed();
        }
        return AccessResult::forbidden();

      case 'update':
        // Only the athlete who logged it or admins can update.
        if ($entity->getAthlete()->id() == $account->id()) {
          return AccessResult::allowed();
        }
        return AccessResult::forbidden();

      case 'delete':
        // Only admins can delete.
        return AccessResult::forbidden();

      default:
        return AccessResult::neutral();
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    // Authenticated users (athletes) can create their own sessions.
    return AccessResult::allowedIf($account->isAuthenticated());
  }

}
