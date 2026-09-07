<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class CheckInListBuilder extends EntityListBuilder {
  public function buildHeader() {
    return ['athlete' => t('Athlete'), 'date' => t('Date'), 'energy' => t('Energy'), 'status' => t('Status')] + parent::buildHeader();
  }
  public function buildRow(EntityInterface $entity) {
    return ['athlete' => $entity->getAthlete()->getDisplayName(), 'date' => $entity->get('check_in_date')->value, 'energy' => $entity->get('energy')->value, 'status' => $entity->get('review_status')->value] + parent::buildRow($entity);
  }
}
