<?php


namespace App\Service\ItemEditor;


use App\Entity\Locale;

interface EntityEditorInterface
{
    public function create(CreateItemInterface $createItem, $block = null);

    public function edit(EditItemInterface $editItem, $entity);

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale);

    public function remove($entity);
}