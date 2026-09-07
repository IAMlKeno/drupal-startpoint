<?php
namespace Drupal\swc\Entity;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class CoachingRelationshipListBuilder extends EntityListBuilder {
  public function buildHeader() {
    $header['id'] = t('ID');
    $header['athlete'] = t('Athlete');
    $header['coach'] = t('Coach');
    $header['start_date'] = t('Start Date');
    $header['status'] = t('Status');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['athlete'] = $entity->getAthlete()->getDisplayName();
    $row['coach'] = $entity->getCoach()->getDisplayName();
    $row['start_date'] = $entity->get('start_date')->value;
    $row['status'] = $entity->get('status')->value;
    return $row + parent::buildRow($entity);
  }
}
