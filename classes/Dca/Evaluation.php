<?php
/**
 * Created by IntelliJ IDEA.
 * User: petr
 * Date: 28.1.15
 * Time: 12:40
 */

namespace Dev\Dca;


class Evaluation
{
	/**
	 * @var Field|null
	 */
	private $field = null;

	function __construct($field = null)
	{
		$this->field = $field;
	}

	/**
	 * true/false (boolean)
	 * If true the helpwizard icon will appear next to the field label.
	 *
	 * @param boolean $helpwizard
	 * @return $this
	 */
	public function helpwizard($helpwizard)
	{
		$this->helpwizard = $helpwizard;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the field cannot be empty.
	 *
	 * @param boolean $mandatory
	 * @return $this
	 */
	public function mandatory($mandatory)
	{
		$this->mandatory = $mandatory;
		return $this;
	}

	/**
	 * Maximum length (integer)
	 * Maximum number of characters that is allowed in the current field.
	 *
	 * @param int $maxlength
	 * @return $this
	 */
	public function maxlength($maxlength)
	{
		$this->maxlength = $maxlength;
		return $this;
	}

	/**
	 * Minimum length (integer)
	 * Minimum number of characters that have to be entered.
	 *
	 * @param int $minlength
	 * @return $this
	 */
	public function minlength($minlength)
	{
		$this->minlength = $minlength;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the field can only be assigned once per table.
	 *
	 * @param boolean $fallback
	 * @return $this
	 */
	public function fallback($fallback)
	{
		$this->fallback = $fallback;
		return $this;
	}
	
	

	/**
	 *    Regular expression (string)
	 *
	 *   alias | expects a valid alias
	 *  ---------------------------------
	 *   - alnum  | allows alphanumeric characters only (including full stop [.] minus ­, underscore [_] and space [ ])
	 *   - alpha  | allows alphabetic characters only (including full stop [.] minus ­ and space [ ])
	 *   - date   | expects a valid date
	 *   - datim  | expects a valid date and time
	 *   - digit  | allows numeric characters only (including full stop [.] and minus ­)
	 *   - email  | expects a valid e-mail address
	 *   - emails | expects a valid list of valid e-mail addresses
	 *   - extnd  | disallows #&()/<=>
	 *   - folderalias  | expects a valid folder URL alias
	 *   - friendly |  expects a valid "friendly name format" e-mail address
	 *   - phone  | expects a valid phone number (numeric characters, space [ ], plus [+], minus , parentheses [()] and slash [/])
	 *   - prcnt  | allows numbers between 0 and 100
	 *   - url    | expects a valid URL
	 *   - time   | expects a valid time
	 *
	 * @param string $rgxp
	 * @return $this
	 */
	public function rgxp($rgxp)
	{
		$this->rgxp = $rgxp;
		return $this;
	}

	/**
	 * Columns (integer)
	 * Number of columns (textarea fields only).
	 *
	 * @param int $cols
	 * @return $this
	 */
	public function cols($cols)
	{
		$this->cols = $cols;
		return $this;
	}

	/**
	 * Rows (integer)
	 * Number of rows (textarea fields only).
	 *
	 * @param int $rows
	 * @return $this
	 */
	public function rows($rows)
	{
		$this->rows = $rows;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * Make the input field multiple. Applies to text fields, select menus,
	 * radio buttons and checkboxes. Required for the checkbox wizard.
	 *
	 * @param boolean $multiple
	 * @return $this
	 */
	public function multiple($multiple)
	{
		$this->multiple = $multiple;
		return $this;
	}

	/**
	 * Size (integer)
	 * Size of a multiple select menu or number of input fields.
	 *
	 * @param int $size
	 * @return $this
	 */
	public function size($size)
	{
		$this->size = $size;
		return $this;
	}

	/**
	 * Style attributes (string)
	 * Style attributes (e.g. border:2px).
	 *
	 * @param string $style
	 * @return $this
	 */
	public function style($style)
	{
		$this->style = $style;
		return $this;
	}

	/**
	 * Rich text editor file (string)
	 * - tinyMCE : use file config/tinyMCE.php.
	 * - tinyFlash : use file config/tinyFlash.php.
	 * You can add your own configuration files too.
	 *
	 * @param string $rte
	 * @return $this
	 */
	public function rte($rte)
	{
		$this->rte = $rte;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the form will be submitted when the field value changes.
	 *
	 * @param boolean $submitOnChange
	 * @return $this
	 */
	public function submitOnChange($submitOnChange)
	{
		$this->submitOnChange = $submitOnChange;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true whitespace characters will not be allowed.
	 *
	 * @param boolean $nospace
	 * @return $this
	 */
	public function nospace($nospace)
	{
		$this->nospace = $nospace;
		return $this;
	}

	/**
	 * If true the current field will accept HTML input.
	 *
	 * @param boolean $allowHtml
	 * @return $this
	 */
	public function allowHtml($allowHtml)
	{
		$this->allowHtml = $allowHtml;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true no HTML tags will be removed at all.
	 *
	 * @param boolean $preserveTags
	 * @return $this
	 */
	public function preserveTags($preserveTags)
	{
		$this->preserveTags = $preserveTags;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true HTML entities will be decoded. Note that HTML entities are always decoded if allowHtml is true.
	 *
	 * @param boolean $decodeEntities
	 * @return $this
	 */
	public function decodeEntities($decodeEntities)
	{
		$this->decodeEntities = $decodeEntities;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the field will not be saved if it is empty.
	 *
	 * @param boolean $doNotSaveEmpty
	 * @return $this
	 */
	public function doNotSaveEmpty($doNotSaveEmpty)
	{
		$this->doNotSaveEmpty = $doNotSaveEmpty;
		return $this;
	}

	/**
	 * If true the field will always be saved, even if its value has not changed. This can be useful in conjunction with a load_callback.
	 * @param boolean $alwaysSave
	 * @return $this
	 */
	public function alwaysSave($alwaysSave)
	{
		$this->alwaysSave = $alwaysSave;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true any whitespace character will be replaced by an underscore.
	 *
	 * @param boolean $spaceToUnderscore
	 * @return $this
	 */
	public function spaceToUnderscore($spaceToUnderscore)
	{
		$this->spaceToUnderscore = $spaceToUnderscore;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the field value cannot be saved if it exists already.
	 *
	 * @param boolean $unique
	 * @return $this
	 */
	public function unique($unique)
	{
		$this->unique = $unique;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the field value will be stored encrypted.
	 *
	 * @param boolean $encrypt
	 * @return $this
	 */
	public function encrypt($encrypt)
	{
		$this->encrypt = $encrypt;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true a trailing slash will be added to the field value.
	 * If false, an existing trailing slash will be removed from the field value.
	 *
	 * @param boolean $trailingSlash
	 * @return $this
	 */
	public function trailingSlash($trailingSlash)
	{
		$this->trailingSlash = $trailingSlash;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true files and folders will be shown.
	 * If false, only folders will be shown.
	 *
	 * Applies to file trees only.
	 *
	 * @param boolean $files
	 * @return $this
	 */
	public function files($files)
	{
		$this->files = $files;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * Removes the radio buttons or checkboxes next to folders.
	 *
	 * Applies to file trees only.
	 *
	 * @param boolean $filesOnly
	 * @return $this
	 */
	public function filesOnly($filesOnly)
	{
		$this->filesOnly = $filesOnly;
		return $this;
	}

	/**
	 * File extensions (string)
	 * Limits the file tree to certain file types (comma separated list). Applies to file trees only.
	 *
	 * @param string $extensions
	 * @return $this
	 */
	public function extensions($extensions)
	{
		$this->extensions = $extensions;
		return $this;
	}

	/**
	 * Path (string)
	 * Custom root directory for file trees.
	 *
	 * Applies to file trees only.
	 *
	 * @param string $path
	 * @return $this
	 */
	public function path($path)
	{
		$this->path = $path;
		return $this;
	}

	/**
	 *  * Input field type (string)
	 *
	 *  - checkbox allow multiple selections
	 *  - radio allow a single selection only
	 *
	 * Applies to file and page trees only.
	 *
	 * @param string $fieldType
	 * @return $this
	 */
	public function fieldType($fieldType)
	{
		$this->fieldType = $fieldType;
		return $this;
	}

	/**
	 *    true/false (boolean)
	 * If true a blank option will be added to the options array. Applies to drop-down menus only.
	 *
	 * @param boo $includeBlankOption
	 * @return $this
	 */
	public function includeBlankOption($includeBlankOption)
	{
		$this->includeBlankOption = $includeBlankOption;
		return $this;
	}

	/**
	 * Label for the blank option (defaults to -).
	 * @param string $blankOptionLabel
	 * @return $this
	 */
	public function blankOptionLabel($blankOptionLabel)
	{
		$this->blankOptionLabel = $blankOptionLabel;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * Sort by the actual option values instead of their labels.
	 *
	 * @param boolean $findInSet
	 * @return $this
	 */
	public function findInSet($findInSet)
	{
		$this->findInSet = $findInSet;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the current field has a date picker.
	 *
	 * @param boolean $datepicker
	 * @return $this
	 */
	public function datepicker($datepicker)
	{
		$this->datepicker = $datepicker;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the current field can be edited in the front end. Applies to table tl_member only.
	 *
	 * @param boolean $feEditable
	 * @return $this
	 */
	public function feEditable($feEditable)
	{
		$this->feEditable = $feEditable;
		return $this;
	}

	/**
	 * Group name (string)
	 * personal personal data - address address details - contact contact details - login login details (table tl_member only) - You can also define your own groups.
	 *
	 * @param string $feGroup
	 * @return $this
	 */
	public function feGroup($feGroup)
	{
		$this->feGroup = $feGroup;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the current field is viewable in the member listing module.
	 *
	 * @param boolean $feViewable
	 * @return $this
	 */
	public function feViewable($feViewable)
	{
		$this->feViewable = $feViewable;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the current field will not be duplicated if the record is duplicated.
	 *
	 * @param boolean $doNotCopy
	 * @return $this
	 */
	public function doNotCopy($doNotCopy)
	{
		$this->doNotCopy = $doNotCopy;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the field value will be hidden (it is still visible in the page source though!).
	 *
	 * @param boolean $hideInput
	 * @return $this
	 */
	public function hideInput($hideInput)
	{

		$this->hideInput = $hideInput;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * If true the current field will not be shown in "edit all" or "show details" mode.
	 *
	 * @param boolean $doNotShow
	 * @return $this
	 */
	public function doNotShow($doNotShow)
	{
		$this->doNotShow = $doNotShow;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * Indicates that a particular field is boolean.
	 *
	 * @param boolean $isBoolean
	 * @return $this
	 */
	public function isBoolean($isBoolean)
	{
		$this->isBoolean = $isBoolean;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * Disables the field (not supported by all field types).
	 *
	 * @param boolean $disabled
	 * @return $this
	 */
	public function disabled($disabled)
	{
		$this->disabled = $disabled;
		return $this;
	}

	/**
	 * true/false (boolean)
	 * Makes the field read only (not supported by all field types).
	 *
	 * @param boolean $readonly
	 * @return $this
	 */
	public function readonly($readonly)
	{
		$this->readonly = $readonly;
		return $this;
	}

	/**
	 * Delimiter (string)
	 *
	 * The choice of this field will not be stored as serialized string but rather as given delimiter-separated list. Example: 'eval' => array('csv'=>',')
	 *
	 * @param string $csv
	 * @return $this
	 */
	public function csv($csv)
	{
		$this->csv = $csv;
		return $this;
	}

	/**
	 *
	 * @param Field $field
	 * @return Evaluation
	 */
	public static function factory(Field $field = null)
	{
		return new Evaluation($field);
	}
	
	

	public function toArray()
	{
		$fields = get_object_vars($this);
		$res = array();
		foreach ($fields as $field => $value) {
			if (!is_null($value)) {
				$res[$field] = $value;
			}
		}
		return $res;
	}

	/**
	 * @return Field|null
	 */
	public function getField()
	{
		return $this->field;
	}
	
	

	/**
	 * @param Field|null $field
	 */
	public function setField($field)
	{
		$this->field = $field;
	}


	
	/**
	 * Returns the field passed in on construction
	 * @return Field|null
	 */
	public function endEval(){
		return $this->field;
		
	}

	/**
	 * @var bool
	 */
	private $helpwizard;
	/**
	 * @var bool
	 */
	private $mandatory;
	/**
	 * @var int
	 */
	private $maxlength;
	/**
	 * @var int
	 */
	private $minlength;
	/**
	 * @var bool
	 */
	private $fallback;
	/**
	 * @var string
	 */
	private $rgxp;
	/**
	 * @var int
	 */
	private $cols;
	/**
	 * @var int
	 */
	private $rows;
	/**
	 * @var bool
	 */
	private $multiple;
	/**
	 * @var integer
	 */
	private $size;
	/**
	 * @var string
	 */
	private $style;
	/**
	 * @var string
	 */
	private $rte;
	/**
	 * @var bool
	 */
	private $submitOnChange;
	/**
	 * @var bool
	 */
	private $nospace;
	/**
	 * @var bool
	 */
	private $allowHtml;
	/**
	 * @var bool
	 */
	private $preserveTags;
	/**
	 * @var bool
	 */
	private $decodeEntities;
	/**
	 * @var bool
	 */
	private $doNotSaveEmpty;
	/**
	 * @var bool
	 */
	private $alwaysSave;
	/**
	 * @var bool
	 */
	private $spaceToUnderscore;
	/**
	 * @var bool
	 */
	private $unique;
	/**
	 * @var bool
	 */
	private $encrypt;
	/**
	 * @var bool
	 */
	private $trailingSlash;
	/**
	 * @var bool
	 */
	private $files;
	/**
	 * @var bool
	 */
	private $filesOnly;
	/**
	 * @var string
	 */
	private $extensions;
	/**
	 * @var string
	 */
	private $path;
	/**
	 * @var string
	 */
	private $fieldType;
	/**
	 * @var boo;
	 */
	private $includeBlankOption;
	/**
	 * @var string
	 */
	private $blankOptionLabel;
	/**
	 * @var bool
	 */
	private $findInSet;
	/**
	 * @var bool
	 */
	private $datepicker;
	/**
	 * @var bool
	 */
	private $feEditable;
	/**
	 * @var string
	 */
	private $feGroup;
	/**
	 * @var bool
	 */
	private $feViewable;
	/**
	 * @var bool
	 */
	private $doNotCopy;
	/**
	 * @var bool
	 */
	private $hideInput;
	/**
	 * @var bool
	 */
	private $doNotShow;
	/**
	 * @var bool
	 */
	private $isBoolean;
	/**
	 * @var bool
	 */
	private $disabled;
	/**
	 * @var bool
	 */
	private $readonly;
	/**
	 * @var string
	 */
	private $csv;

	/**
	 * The Contao back end uses a simple two-column grid system to arrange input fields
	 * their groups. You can apply the following CSS classes in the evaluation section
	 * of the Data Container Array as tl_class (e.g. 'tl_class'=>'w50 wizard').
	 *
	 * - w50	 : Set the field width to 50% and float it (float:left).
	 * - clr	 : Clear all floats (clear:both).
	 * - wizard	 : Shorten the input field so there is enough room for the wizard button (e.g. date picker fields).
	 * - long	 : Make the text input field span two columns.
	 * - m12	 : Add a 12 pixels top margin to the element (used for single checkboxes).
	 *
	 *
	 * @param string $tl_class
	 * @return $this
	 */
	public function tlClass($tl_class = '')
	{
		$this->tl_class = $tl_class;
		return $this;
	}

	/**
	 * @var string
	 */
	private $tl_class;


}