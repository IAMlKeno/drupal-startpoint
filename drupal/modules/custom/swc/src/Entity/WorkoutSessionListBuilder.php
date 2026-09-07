<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class WorkoutSessionListBuilder extends EntityListBuilder {
  public function buildHeader() {
    return ['athlete' => t('Athlete'), 'workout' => t('Workout'), 'date' => t('Date'), 'status' => t('Status')] + parent::buildHeader();
  }
  public function buildRow(EntityInterface $entity) {
    return ['athlete' => $entity->getAthlete()->getDisplayName(), 'workout' => $entity->getWorkout()->label(), 'date' => $entity->get('session_date')->value, 'status' => $entity->get('completion_status')->value] + parent::buildRow($entity);
  }
}
