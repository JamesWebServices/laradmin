# Laradmin Field Types & Configuration

The following field types are available to you for use in your configuration file.

- [\Warkensoft\Laradmin\Fields\Input::class](field-types.md#input-field)
- [\Warkensoft\Laradmin\Fields\Password::class](field-types.md#password-field)
- [\Warkensoft\Laradmin\Fields\Textarea::class](field-types.md#textarea-field)
- [\Warkensoft\Laradmin\Fields\Summernote::class](field-types.md#summernote-field)
- [\Warkensoft\Laradmin\Fields\ImageUpload::class](field-types.md#imageupload-field)
- [\Warkensoft\Laradmin\Fields\SelectFromMany::class](field-types.md#selectfrommany-field)


## Input Field

	'type'        => \Warkensoft\Laradmin\Fields\Input::class,
	'name'        => 'title',
	'label'       => 'Sample Title',
	'placeholder' => 'Some Fantastic Title',
	'default'     => '',
	'rules'       => 'required',
	'searchable'  => true,

The input field is your most simple HTML input box, with a label, input box and placeholder. It supports all the 
parameters listed above, most of which are common to the other field types as well.

#### `name`

Provide a string with the name of the field. This should normally match the field name on the model and in the database.

#### `label`

This will be used as the label for the field on the form.

#### `placeholder`

This will be used as the HTML placeholder for the field on the form.

#### `default`

This will be used as the default value for the field on the form.

#### `rules`

The rules for how the field is to be validated. Follows standard Laravel validation terms as described here:
https://laravel.com/docs/5.7/validation#available-validation-rules

#### `searchable`

Optional field. Set to `false` to prevent Laradmin from searching the values in this field.


## Password Field

	'type'        => \Warkensoft\Laradmin\Fields\Password::class,
	'name'        => 'password',
	'label'       => 'Password',
	'placeholder' => 'Enter password here...',
	'rules'       => 'confirmed',
	'searchable'  => false,
	
The password field is only slightly different from the input field and accepts almost all the same configuration 
parameters. The important differences are:

- It is a password field, so input is hidden.
- There is no `value` or `default` displayed on the field. 


## Textarea Field

	'type'        => \Warkensoft\Laradmin\Fields\Textarea::class,
	'name'        => 'body',
	'label'       => 'Content',
	'placeholder' => 'Write something amazing!',
	'default'     => '',
	'rules'       => '',
	'rows'        => 10,

The textarea field presents the user with a textarea box where they may type multiple paragraphs of text. In addition to 
the regular input box fields, it supports a `rows` field. 

#### `rows`

Optionally define how many rows the textarea will display. Default: 6


## Summernote Field

	'type'        => \Warkensoft\Laradmin\Fields\Summernote::class,
	'name'        => 'body',
	'label'       => 'Content',
	'placeholder' => 'Write something amazing!',
	'default'     => '',
	'rules'       => 'required',
	
The summernote field accepts the same parameters as the regular [textarea field](field-types.md#textarea-field). 
It presents the user with a WYSIWYG input area where text may be entered and formatted by using the excellent 
[Summernote](https://summernote.org/) library.


## ImageUpload Field

	'type'        => \Warkensoft\Laradmin\Fields\ImageUpload::class,
	'name'        => 'feature_image',
	'label'       => 'Feature Image',
	'placeholder' => '',
	'default'     => '',
	'rules'       => '',
	'path'        => 'public',
	'uri'         => '/storage',
	
The ImageUpload field presents the user with a file upload field which can be used to upload images related to the model.
The field on the model should be a `string` since it will hold the URL to the file once uploaded. In addition to normal 
input parameters, several other configuration parameters may be used.

#### `path`

Define the path relative to the storage/app folder where the images will be placed. In the example above, using 
`public` as the path will result in the uploads being placed in /storage/app/public, assuming standard Laravel paths
are being used.

#### `uri`

Define the relative path to the image when viewed on the website. In the sample parameters above, the images will be 
uploaded to `/storage/app/public/something.jpg`, but when viewed on the website will be accessible at 
`/storage/something.jpg`.

**IMPORTANT!!** In order for this to work you must create a symlink from the public folder to your storage folder using the
Laravel artisan command `php artisan storage:link`. This will create a symbolic link from `public/storage` to 
`storage/app/public`


## SelectFromMany Field

	'type'        => \Warkensoft\Laradmin\Fields\SelectFromMany::class,
	'name'       => 'author_id',
	'label'       => 'Author ID',
	'placeholder' => '',
	'default'     => '',
	'rules'       => 'integer',
	'relation'    => [
		'type'   => 'one-to-many',
		'model'  => \App\User::class,
		'method' => 'author',
		'key'    => 'id',
		'label'  => 'name',
	]

This field presents the user with a selection dropdown containing a list of related models. A field set up with the 
example parameters above would work well on a `Page` model to display a list of users to choose an author.

The type of field used on the model should match the primary key of the related model. The model class should also be set
up with a `belongsTo()` relationship pointed to the related model.

For example, if using the parameters above in a `Page` class, one would need to have an `UNSIGNED INT author_id` field
in the database and a method like the following on the model:

	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
    }

#### Relation Fields

#### `type`

Defines what type of relationship is used. Current types are:

- one-to-many

#### `model`

The related model class name.

#### `method`

The name of the method in the current class which describes the `belongsTo()` relationship. 

#### `key`

The primary key of the related model. This will corrospond to the field name on the current model. 

#### `label`

The name of the field used in displaying the data from this relationship on indexes. For the example above, the `Pages`
index will display the `$user->name` field in a column related to each page.