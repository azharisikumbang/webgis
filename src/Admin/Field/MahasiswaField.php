<?php

namespace App\Admin\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\String\UnicodeString;

final class MahasiswaField implements FieldInterface
{
	use FieldTrait;

	public static function new(string $propertyName, ?string $label = null)
	{
		return (new self())
			->setProperty($propertyName)
			->setLabel($label);
	}

	public function textType($value = null) 
	{
        $this->setFieldFqcn(TextField::class);
        $this->setTemplatePath("@EasyAdmin/crud/field/text.html.twig");
        $this->setFormType(TextType::class);
        $this->setValue($value);
        $this->addCssClass("field-text");
        $this->setFormattedValue(new UnicodeString($value));

        return $this;
	}

	public function setRequired() 
	{
		$this->setFormTypeOptions(["required" => true]);
		return $this;
	}
}