<?php

namespace Drupal\swc\Entity;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines a list builder for workout sessions.
 */
class WorkoutSessionListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('Session ID');
    $header['athlete'] = t('Athlete');
    $header['workout'] = t('Workout');
    $header['session_date'] = t('Date');
    $header['completion_status'] = t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['athlete'] = $entity->getAthlete()->getDisplayName();
    $row['workout'] = $entity->getWorkout()->label();
    $row['session_date'] = $entity->get('session_date')->value;
    $row['completion_status'] = $entity->get('completion_status')->value;
    return $row + parent::buildRow($entity);
  }

}
