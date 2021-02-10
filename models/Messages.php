<?php namespace Thodin\SoobshcheniyaOtFormyZahvata\Models;

use Model;

/**
 * Model
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property string $utm
 * @property string $url
 * @property string $element
 * @property bool   $is_sanded
 * @property string $form
 */
class Messages extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'thodin_soobshcheniyaotformyzahvata_messages';

    /**
     * @var array Validation rules
     */
    public $rules = [];
}
