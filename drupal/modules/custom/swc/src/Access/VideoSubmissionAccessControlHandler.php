<?php
namespace Drupal\swc\Access;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

class VideoSubmissionAccessControlHandler extends EntityAccessControlHandler {
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    if ($account->hasRole('administrator')) return AccessResult::allowed();
    switch ($operation) {
      case 'view':
        if ($entity->getAthlete()->id() == $account->id() || ($account->hasRole('coach') && !$entity->get('coach')->isEmpty() && $entity->get('coach')->target_id == $account->id())) return AccessResult::allowed();
        return AccessResult::forbidden();
      case 'update':
        if ($account->hasRole('coach') && !$entity->get('coach')->isEmpty() && $entity->get('coach')->target_id == $account->id()) return AccessResult::allowed();
        return AccessResult::forbidden();
      case 'delete':
        return AccessResult::forbidden();
      default:
        return AccessResult::neutral();
    }
  }
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIf($account->hasRole('athlete'));
  }
}
