<?php

namespace Drupal\swc\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines a list builder for challenge enrollments.
 */
class ChallengeEnrollmentListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('Enrollment ID');
    $header['athlete'] = t('Athlete');
    $header['challenge'] = t('Challenge');
    $header['status'] = t('Status');
    $header['joined_date'] = t('Joined Date');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['athlete'] = $entity->getAthlete()->getDisplayName();
    $row['challenge'] = $entity->getChallenge()->label();
    $row['status'] = $entity->get('status')->value;
    $row['joined_date'] = $entity->get('joined_date')->value;
    return $row + parent::buildRow($entity);
  }

}
