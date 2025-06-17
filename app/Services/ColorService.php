<?php
namespace App\Services;

use App\Enums\ColorMediaEnum;
use App\Models\Color;

class ColorService
{
    public function index()
    {
        $colors = Color::paginate();
        return $colors;
    }

    public function create($data)
    {
        $color = color::create($data);
        $color->setTranslations('title', [
            'en' => $data['title_en'],
            'ar' => $data['title_ar']
        ]);
        if (array_key_exists('image', $data)) {
            $color
                ->addMedia($data['image'])
                ->toMediaCollection(ColorMediaEnum::MAIN_IMAGE->value);
        }
        $color->save();
        return $color;
    }

    public function getColorById($id)
    {
        $color = Color::findOrFail($id);
        return $color;
    }

    public function delete($id)
    {
        $color = $this->getColorById($id);
        $color->delete();
    }

    public function update($id, $data)
    {
        $color = $this->getColorById($id);
        $color->update($data);
        $color->setTranslations('title', [
            'en'=> $data['title_en'],
            'ar'=> $data['title_ar']
            ]);
            if (array_key_exists('image', $data)) {
                $color
                ->addMedia($data['image'])
                ->toMediaCollection(ColorMediaEnum::MAIN_IMAGE->value);
            }
            $color->save();
            return $color;


    }
}
