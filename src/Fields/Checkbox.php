<?php namespace Warkensoft\Laradmin\Fields;

class Checkbox extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.checkbox';
	}
}