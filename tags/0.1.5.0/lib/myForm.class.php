<?php
/**
 * Inclusion de clases para el fckeditor
 */
$pathfckEditor = 'plugin/editors/fck_editor/fckeditor.php';
require ($pathfckEditor);


/**
 * myForm
 *
 * @uses Creacion de formularios
 * @package OSEZNO FRAMEWORK
 * @version 1.6.0
 * @author joselitohaCker
 *
 * 
 */
class myForm {

	/**
	 * Version de la clase
	 *
	 * @var string
	 */
	public $Version = '1.6.0';


	/**
	 * El metodo que utilizara en el momento de enviar el Formulario.
	 *
	 * @var string
	 */
	public $Method = 'post';


	/**
	 * En caso de que el form no tenga action, hacer esto.
	 *
	 * @var string
	 */
	private $onSubmitAction = 'return false';


	/**
	 * La ruta del script a la cual va dirigida la informacion.
	 * Ejemplo valida.php
	 * @var string
	 */
	public $Action;


	/**
	 * La ventana en donde se abrira la informacion enviada desde ese formulario.
	 * Valores: _self, _blank, _parent, _top
	 * @var string
	 */
	public $Target = '_self';


	/**
	 * El tipo de datos que va a enviar, usualmente se utiliza para manejar acrchivos.
	 * Valores: application/x-www-form-urlencoded, multipart/form-data
	 * @var string
	 */
	public $Enctype;


	/**
	 * La accion (Funcion) javaScript que realizara cuando haga click en el boton.
	 *
	 * @var string
	 */
	public $jsFunctionEvent;


	/**
	 * Prefijo que usa xajax para llamar a sus funciones
	 *
	 * @var string
	 */
	public $prefAjax = '';


	/**
	 * Etiqueta del boton que enviara los datos del formulario.
	 *
	 * @var string
	 */
	public $strSubmit = 'Submit';


	/**
	 * Nombre del campo oculto utilizado para enviar los valores del formulario via Asincronica.
	 *
	 * @var string
	 */
	public $nameFiledHidden = 'oculto';


	/**
	 * El nombre del formulario con el que se esta interactuando.
	 *
	 * @var string
	 */
	public $NomForm;


	/**
	 * Directorio en donde el formulario sera cacheado
	 *
	 * @var string
	 */
	public $cache_dir = 'myform_cache/';


	/**
	 * Extension de el archivo que la cache generara
	 *
	 * @var string
	 */
	private $cache_ext_file = '';


	/**
	 * Numero de segundos en que la cache de un documento de mantendra
	 *
	 * @var integer
	 */
	private $cache_int_seconds_time;


	/**
	 * Define si se va a usar o no cache para el formulario
	 *
	 * @var boolean
	 */
	public $use_cache = false;


	/**
	 * Nombre del arreglo que almacena los campos del formulario antes de ser lanzado.
	 *
	 * @var array
	 */
	private $Objects = array();


	/**
	 * Caracter que sera tenido en cuenta para las cadenas que son compuestas por muchos campos.
	 *
	 * @var string
	 */
	private $Separador = "/-/";


	/**
	 * Caracter  que   identifica   despues   de  el
	 * dentro del nombre de un objeto del formulario
	 * el valor  colSpan  que se va a asumir por ese
	 * campo  para  que  sea  alineado correctamente
	 * dentro de la tabla del formulario.
	 *
	 * @var string
	 */
	private $colSpanIdentifier = ':';


	/**
	 * Formato que usa la funcion de javascript de uso de formularios para pasar la fecha seleccionada al campo fecha del formulario
	 *
	 * @var string
	 */
	public $dateFormatCalendar = "%Y-%m-%d";


	/**
	 * Numero de columnas en las que se divira la vista del formulario.
	 *
	 * @var integer
	 */
	public $Cols = 2;


	/**
	 * Numero en px de padding en las celdas
	 *
	 * @var integer
	 */
	public $formCellpadding = 2;

	/**
	 * Numero en px de spacing entre las celdas.
	 *
	 * @var integer
	 */
	public $formCellspacing = 0;


	/**
	 * Tamano de ancho de la tabla que contiene el formulario en porcentaje o px
	 *
	 * @var string
	 */
	public $formWidth = '100%';


	/**
	 * Tamano de alto de la tabla que contiene el formulario en porcentaje o px
	 *
	 * @var string
	 */
	public $formHeight = '100%';


	/**
	 * Borde de la tabla, para programadores
	 *
	 * @var integer
	 */
	public $tableBorder = 0;


	/**
	 * Permite decidir si se va a usar o no
	 * una opcion en el select que  muestre
	 * un determinada etiqueta como presentacion.
	 *
	 * @var boolean
	 */
	public $selectUseFirstValue = true;


	/**
	 * Ruta de la Imagen que acompana el boton que cierra el formulario
	 *
	 * @var string
	 */
	public $SrcImageButton = 'save.png';


	/**
	 * Ruta de la Imagen que acompana el boton de cada uno de los Controles de calendario
	 *
	 * @var string
	 */
	public $SrcImageCalendarButton  = 'calendar.png';


	/**
	 * Nombre del boton que envia la informacion del Formulario
	 *
	 * @var string
	 */
	public $idButtonSubmit = 'enviar';


	/**
	 * Path subcarpeta dentro de la carpeta principal del poryecto
	 *
	 * @var string
	 */
	public $subFolder_inImg = '/img/my_form/';
		
	/**
	 * Contador interno que lleva la cuenta y genera un id unico
	 * para cada uno de los Radio buttons que se generen
	 *
	 * @var integer
	 */
	private $counterRediosForThisForm = 0;


	/**
	 * Guarda informacion sobre los campos de un formulario que
	 * aun no se encuentra validado.
	 *
	 * @var string
	 */
	public $errorValidacion = "Validando formulario; faltan los siguientes campos:\n";


	/**
	 * Etiqueta de la primera opcion por select
	 * que se activa solo si $objMyForm->selectUseFirstValue
	 * es igual a 'true'
	 *
	 * @var string
	 */
	public $strLabelFirstOptionOnSelect = 'Seleccione...';


	/**
	 * Es un copia de los elementos que dentro del formulario deben ser obligatorios llenar
	 *
	 * @var array
	 */
	private $arrayRequiredFiled = array ();


	/**
	 * Guarda temporalmente cada uno de los
	 * valores de el formulario, para poder
	 * accederlos mas adelante y poder com
	 * pilar el formulario.
	 *
	 * @var array
	 */
	private $arrayFormElements = array ();

	
	/**
	 * Tiene registrados los alias de los atributos
	 * por cada fila generada en el formulario para
	 * que en la compilacion del fomrulario podamos
	 * reemplazarlos por sus respectivos valores.
	 *
	 * @var array
	 */
	private $arrayAttributesToReplaceInRow = array('widthEtq','widthFld','colSpanEtq','colSpanFld','rowSpanEtq','rowSpanFld');
	
	
	/**
	 * Guarda temporalmente propiedades de cada
	 * unos de los campos referente a el colspan
	 * que ocupa cada uno de ellos en las tablas.
	 *
	 * @var array
	 */
	private $arrayFormElementsColspan = array();


	/**
	 * Guarda temporalmente propiedades de cada
	 * unos de los campos referente a el rowspan
	 * que ocupa cada uno de ellos en las tablas.
	 *
	 * @var array
	 */
	private $arrayFormElementsRowspan = array();
	
	
	
	/**
	 * Guarda los tipos de elemento por cada uno
	 * de los objetos del formulario.
	 *
	 * @var array
	 */
	private $arrayFormElementType = array();


	/**
	 * Arreglo que contiene los botones adionales que el
	 * formulario pueda tener.
	 *
	 * @var array
	 */
	private $arrayButtonList = array();


	/**
	 * Arreglo protegido que almacena los eventos Xajax para los que se le fueron asignados
	 *
	 * @var array
	 */
	protected $objEventxJ = array();


	/**
	 * Arreglo que contiene los nombres de los objetos que tendran la propiedad Disabled
	 * dentro del formulario
	 *
	 * @var array
	 */
	protected $objDisabled = array();


	/**
	 * Arreglo que contiene los nombres de los objetos que
	 * estan referenciados como objetos del formulario que
	 * contendran un nivel de ayuda.
	 *
	 * @var array
	 */
	protected $objHelps = array ();


	/**
	 * Arreglo que contiene los nombres de los objetos que
	 * estan referenciado como  objetos del formulario que
	 * van a usar helpers, y que solo es valido para   los
	 * campos de tipo texto.
	 *
	 * @var array
	 */
	protected $objHelpers = array ();


	/**
	 * Ruta de la carpeta del servidor donde se alojan los archivos
	 * subidos por el method upload
	 *
	 * @var string
	 */
	private $uploadDirectory = '';


	/**
	 * Arreglo de los campos tipo 'FILE' que estan registrados
	 * dentro del formulario para ser mostrados
	 *
	 * @var array
	 */
	private $uploaderIdArray = array();


	/**
	 * Nombre de la clase que por defecto usan las
	 * tablas que se crean para el formulario.
	 *
	 * @var string
	 */
	public $styleClassTableForm = 'fondo_tabla_form';


	/**
	 * Nombre de la clase que por defecto usan las
	 * filas del medio para los formularios.
	 *
	 * @var string
	 */
	public $styleClassRowSeparator = 'fondo_fila_medio';



	/**
	 * Tipo del la ayuda que mostrara el help
	 * sobre los campos que se configuraron
	 * previamente.
	 *
	 * 1, 2
	 *
	 * @var integer
	 */
	public $styleTypeHelp = 1;



	/**
	 * Utilizar o no la fila intermedia de color diferente para
	 * diferenciar visualmente las filas de los campos en un formulario.
	 * Nota: Al activar este atributo debe tenerse en cuenta la clase
	 * de estilos que usa por medio de 'styleClassRowSeparator'
	 *
	 * @var boolean
	 */
	public $useRowSeparator = false;


	/**
	 * Nombre de la clase que por defecto usan los
	 * campos del formulario para ser mostrados.
	 *
	 * @var string
	 */
	public $styleClass = 'caja';


	/**
	 * Nombre de la clase que por defecto usan los
	 * los botones del formulario que seran mostrados.
	 *
	 * @var string
	 */
	public $styleClassButtons = 'boton';


	/**
	 * Nombre de la clase que por defecto usan los
	 * loas etiquetas de los campos del formulario que seran mostrados.
	 *
	 * @var string
	 */
	public $styleClassTags = 'etiqueta';


	/**
	 * Nombre de la clase que por defecto usan los
	 * fieldsets del formulario.
	 *
	 * @var string
	 */
	public $styleClassFieldsets = 'formulario_fieldset';


	/**
	 * Etiqueta del Legend del Fieldset que usara el formulario
	 *
	 * @var string
	 */
	public $strNameFieldSet = '';


	/**
	 * Arreglo que contiene los idNames de los agrupamientos
	 * en el formulario actuales
	 *
	 * @var array
	 */
	private $arrayGroups = array();


	/**
	 * Arreglo que contiene los elementos que ya han sido
	 * incluidos dentro de los demas grupos
	 *
	 * @var array
	 */
	private $arrayElementsInGroups = array();


	/**
	 * Guarda temporalmente el HTML de cada Grupo
	 * de elementos
	 *
	 * @var mixed
	 */
	private $arrayGroupsElementsHTML = array();


	/**
	 * Contiene los id de cada uno de los
	 * agrupamientos de los grupos que se
	 * estan formando para compartir  una
	 * fila.
	 *
	 * @var mixed
	 */
	private $arrayGroupsIdInShareSpace = array();


	/**
	 * Contiene un listado de los grupos
	 * que ya fueron mostrados con ante-
	 * rioridad.
	 *
	 * @var mixed
	 */
	private $arrayGroupsShown = array();


	/**
	 * Contiene un listado de los  elementos
	 * del formulario que ya habian sido lan
	 * zados anteriormente para no volverlos
	 * a mostrar cuando termine de mostrarse
	 * cada uno de los grupos.
	 *
	 * @var mixed
	 */
	private $arrayFormElementsShown = array ();


	/**
	 * Contiene los nombres de los campos que
	 * ya habian sido definidos dentro de  la
	 * clase como objetos del formulario pero
	 * no han sido mostrados dento de   algun
	 * grupo.
	 *
	 * @var mixed
	 */
	private $arrayFormElementsToShow = array();


	/**
	 * Arreglo que contiene los nombres de los
	 * eventos que han sido definidos.
	 *
	 * @var array
	 */
	private $arrayEventsDefined = array();



	/**
	 * Parametros de Configuracion del SWFUpload
	 * 
	 * Recordar que cuando se anuncia o se hace llamado 
	 * a file object que puede ser pasado como parametro 
	 * a un evento este trae informacion del archivo
	 * que se esta intentando subir al servidor.
	 * 
	 * id : string,			    // SWFUpload file id, used for starting or cancelling and upload
	 * index : number,			// The index of this file for use in getFile(i)
	 * name : string,			// The file name. The path is not included.
	 * size : number,			// The file size in bytes
	 * type : string,			// The file type as reported by the client operating system
	 * creationdate : Date,		// The date the file was created
	 * modificationdate : Date,	// The date the file was last modified
	 * filestatus : number,		// The file's current status. Use SWFUpload.FILE_STATUS to interpret the value.
	 * 
	 */
	

	/**
	 * Url del archivo que sube los archivos
	 * al servidor por via post.
	 *
	 * @var string
	 */
	public $SWF_upload_url;
	# Un ejemplo de el script que sube los datos puede ser ...
	# - Inicio
	//   // Si se pretende conservar el ID de la sesion actual, se hace con un parametro GET
	//    if(isset($_GET['SessionID'])){
	//       // session_id devuelve el ID de la sesion actual, o setea el ID de la nueva sesion
	//      session_id(trim($_GET['SessionID']));
	//    }
	//   // Si se requiere iniciar sesion
	//   //session_start();
	//   // Decidimos donde vamos a poner el Archivo que subimos
	//   $folder_destino = $_SERVER['DOCUMENT_ROOT']."/".$_FILES['Filedata']['name'];
	//   // Intentamos mover el archivo al directorio destino
	//   if (@move_uploaded_file($_FILES['Filedata']['tmp_name'],$folder_destino)){
	//      // Aqui se movio
	//	  header('HTTP/1.1 200 OK');
	//      // Si el envio falla
	//   }else {
	//	  // Reportar el error
	//	  header('HTTP/1.1 404 Not Found');
	//	  // Guardar el error en un archivo
	//	  error_log("Error al intentar enviar archivo: ".$_FILES['Filedata']['name'].' '.date("Y-m-d")."\n",3,"logs.txt");
	//   }
	//   print 'ok!';
	# - Fin


	/**
	 * El nombre del campo cuando es enviado
	 * por el metodo POST, The Linux Flash Player ignores this setting.
	 *
	 * @var string
	 */
	public $SWF_file_post_name;


	/**
	 * The param_object should be a simple JavaScript object.
	 * All names and values must be strings
	 *
	 * @var string
	 */
	public $SWF_post_params = array();


	/**
	 * Los tipos de archivo que son admisibles
	 *
	 * @var array
	 */
	public $SWF_file_types = array('*.*');



	/**
	 * La descripcion de los tipos de archivo
	 * que se pueden subir al servidor
	 *
	 * @var string
	 */
	public $SWF_file_types_description = 'Todos los tipos';



	/**
	 * El tamano maximo en kilobytes
	 * para que un archivo pueda ser
	 * subido al  servidor de datos.
	 *
	 * @var integer
	 */
	public $SWF_file_size_limit = 2048;


	/**
	 * Setea si se va a mostrar o no informacion de 
	 * la capacidad max de subida por archivo en el boton
	 * que abre la ventana de dialogo para el swf_uploader
	 *
	 * @var unknown_type
	 */
	public $SWF_show_max_upload_size_info_in_button = true;
	

	/**
	 * Numero maximo de archivos que
	 * pueden ser subidos.
	 *
	 * @var integer
	 */
	public $SWF_file_upload_limit = 0;


	/**
	 * Numero maximo de archivos en
	 * archivos en  cola que pueden
	 * estar.
	 *
	 * @var integer
	 */
	public $SWF_file_queue_limit = 10;



	/**
	 * Url en donde se encuentra el
	 * SWF que permite la carga  de
	 * los archivos al servidor.
	 *
	 * @var string
	 */
	public $SWF_flash_url = '';


	/**
	 * Ancho de el tamano del flash.
	 *
	 * @var string
	 */
	public $SWF_flash_width = '0px';



	/**
	 * Alto de el tamano del flash.
	 *
	 * @var string
	 */
	public $SWF_flash_height = '0px';


	/**
	 * Color de piel para el flash.
	 *
	 * @var string
	 */
	public $SWF_flash_color = 'FFFFFF';



	/**
	 * Habilitar el debug o no
	 *
	 * @var bool
	 */
	public $SWF_debug = 'false';


	/**
	 * The swfUploadLoaded event is fired by flashReady. It is overridable. When swfUploadLoaded is called it is safe to call SWFUpload methods.
	 *
	 * @var string
	 */
	public $SWF_swfupload_loaded_handler = 'swfuploadLoadedHandler';


	/**
	 * Este evento se dispara inmediatamente antes de que la
	 * ventana de dialogo de seleccion de archivos sea abierta.
	 * Sin embargo el evento no va a terminar ni a cerrarse hasta
	 * que la ventana dialogo de seleccion de archivos este sea
	 * cerrada por cancelacion, o aceptacion. 
	 *
	 * Parametros que se pasan al evento: Ninguno 
	 *  
	 * @var string
	 */
	public $SWF_file_dialog_start_handler = 'fileDialogStart';



	/**
	 * No usar o tener en cuenta este evento.
	 *
	 * @var string
	 */
	public $SWF_file_queued_handler = 'fileQueued';


	/**
	 * Se ejecuta cuando existe o se produjo un
	 * error de validacion en la lista seleccionada
	 * de los archivos  que el  usuario selecciono
	 * Por ejemplo para ayudar a validar que el archivo
	 * no sea demasiado grande o que sea del tipo
	 * que se esta parametrizando.
	 *
	 * Parametros que se pasan al evento: (file object, error code, message)
	 * 
	 * @var string
	 */
	public $SWF_file_queue_error_handler = 'fileQueueError';


	/**
	 * Se ejecuta cuando se a echo click sobre el
	 * boton aceptar del cuadro de dialogo de los
	 * archivos que van a ser subidos al servidor
	 * Esto generalmente esta haciendo el cargue
	 * automatico de los archivos con "this.startUpload();"
	 *
	 * Parametros que se pasan al evento: (number of files selected, number of files queued)
	 * 
	 * @var string
	 */
	public $SWF_file_dialog_complete_handler = 'fileDialogComplete';



	/**
	 * Funcion que es llamada cuando comienza todo
	 * el cargue completo de los archivos y para que
	 * en cierta forma tambien se pueda hacer automaticamente
	 *
	 * Parametros que se pasan al evento: (file object)
	 * 
	 * @var string
	 */
	public $SWF_upload_start_handler = 'uploadStart';



	/**
	 * Se produce cuando el listado de los archivos
	 * que actualmente se han seleccionado estan en
	 * proceso de ser subidos al servidor.
	 *
	 * Parametros que se pasan al evento: (file object, bytes complete, total bytes)
	 * 
	 * @var string
	 */
	public $SWF_upload_progress_handler = 'uploadProgress';



	/**
	 * El evento es uploadError se dispara en cualquier momento
	 * cuando la carga de un archivo se interrumpe o no se completa con �xito. 
	 * El c�digo de error par�metro indica el tipo de error que se produjo. 
	 * El c�digo de error par�metro especifica una constante en SWFUpload.UPLOAD_ERROR.
	 * 
	 * Parametros que se pasan al evento: (file object, error code, message)
	 * 
	 * @var string
	 */
	public $SWF_upload_error_handler = 'uploadError';


	/**
	 * Este evento se ejecuta cuando un archivo es subido exitosamente
	 * al servidor, mientras tanto otros archivos pueden seguir siendo
	 * subidos.
	 *
	 * Parametros que se pasan al evento: (file object, server data)
	 *  
	 * @var string
	 */
	public $SWF_upload_success_handler = 'uploadSuccess';


	/**
	 * Este evento siempre se dispara al final de un ciclo de una carga.
	 * En este punto la carga esta completa y otra puede comenzar.
	 *
	 * Parametros que se pasan al evento: (file object)
	 * 
	 * @var string
	 */
	public $SWF_upload_complete_handler = 'uploadComplete';


	/**
	 * Enter description here...
	 *
	 * @var string
	 */
	public $SWF_debug_handler = 'debugHandler';



	/**
	 * Enter description here...
	 *
	 * @var array
	 */
	public $SWF_custom_settings = array();


	/**
	 * Ruta de la imagen que acompa�a el boton
	 * examinar para el cargue de los archivos
	 *
	 * @var string
	 */
	public $SWF_src_img_button = '';


	/**
	 * Texto que esta dentro del boton
	 * quen  examina   los   archivos.
	 *
	 * @var string
	 */
	public $SWF_str_etq_button = 'Examinar y subir';


	/**
	 * Decidir si por upload se pueden se
	 * leccionar  varios  archivos  o no.
	 *
	 * @var boolean
	 */
	private $SWF_upload_several_files = false;


	# Atributos de inicio de configuracion para el editor FCKeditor

	/**
	 * Ruta base de acceso para encontrar los script del editor
	 * Se necesita para llamar correctamente al FCKeditor
	 * Normalmente se puede localizar en URL_BASE_PROJECT.'/lib/plugin/editors/fck_editor/';
	 *
	 * @var string
	 */
	public $FCK_editor_BasePath = '';


	/**
	 * Ancho de FCKeditor
	 *
	 * @var string
	 */
	public $FCK_editor_Width  = '100%';


	/**
	 * Alto del FCKeditor
	 *
	 * @var string
	 */
	public $FCK_editor_Height = '200';


	/**
	 * Idioma por defecto a mostrar
	 *
	 * @var string
	 */
	public $FCK_editor_Laguage = 'es';


	/**
	 * Grupo de barras a seleccionar
	 *
	 * @var string
	 */
	public $FCK_editor_ToolbarSet = 'Default';


	public $MYLIST_color_borde = '#000000';
	public $MYLIST_color_fila_del_medio = '#FFFFFF';
	public $MYLIST_color_fila_defecto = '#FFFFFF';
	public $MYLIST_color_cabeza_columna = '#FFFFFF';
	public $MYLIST_color_columna_seleccionada = '#FFFFFF';
	public $MYLIST_usar_distincion_filas = true;
	public $MYLIST_estilo_cabeza_columnas;
	public $MYLIST_estilo_enlaces;
	public $MYLIST_estilo_datos;
	public $MYLIST_titulo_formulario_parametros;
	public $MYLIST_ancho_lista = '100%';

	/**
	 * Verifica si un objeto tipo file ha sido
	 * agregado al formulario para mas adelante
	 * en la compilacion del formulario incluir
	 * o no el fuente javascript de dicho objeto.
	 *
	 * @var bool
	 */
	private $useAddFile = false;

	/**
	 * Constructor de la clase de generacion de formularios
	 *
	 * @param string  $nomForm  	Nombre del formulario
	 * @param string  $Action   	El nombre del script a donde va la informacion
	 * @param string  $jsScript 	En caso de que el form no tenga Action, entonces el boton realizara este evento
	 * @param string  $enctype  	Tipo de informacion que maneja
	 * @param string  $target   	Parametro de apertura de los datos
	 * @param boolean $boolUseCache Usar o no cache en el formulario
	 * @param integer $intSeconds   Numero de segundos en que la cache del formulario dura activa 
	 */
	public function __construct($nomForm, $Action = '', $jsScript = '', $enctype = '',  $target = '', $boolUseCache, $intSeconds){
		$this->NomForm = $nomForm;

		if ($Action)
			$this->Action = $Action;
			
		if ($jsScript)
			$this->jsFunctionEvent = $jsScript;
			
		if ($enctype)
			$this->Enctype = $enctype;
			
		if ($target)
			$this->Target = $target;
		
		if (isset($boolUseCache) && isset($intSeconds))
		   $this->setCache($boolUseCache, $intSeconds);
	}

	/**
	 * Imprimir el javascript necesario para
	 * cargar la el SWFUploader, este se debe imprimir
	 * entre las etiquetas <head></head>
	 *
	 */
	public function printJavaScriptSWFUploader (){
		print $this->getJavaScriptSWFUploader();
	}

	/**
	 * Obtener el javascript necesario para
	 * imprimirlo en las etiquetas <head></head>
	 * para el cargar la configuracion del SWFUploader
	 *
	 */
	public function getJavaScriptSWFUploader (){
		$JS = '';
			
		$JS.= '<script type="text/javascript">'."\n";
		$JS.= 'var swfu;'."\n";
		$JS.= 'window.onload = function() {'."\n";
		$JS.= 'swfu = new SWFUpload({'."\n";

		$JS.= '// Backend Settings'."\n";
		$JS.= "\t".'upload_url : "'.$this->SWF_upload_url.'",'."\n";
			
		if (count($this->SWF_file_post_name)){
			$JS.= 'post_params : {'."\n";
			$swf_file_post_name_Keys = array_keys($this->SWF_file_post_name);
			for ($i=0;$i<count($this->SWF_file_post_name);$i++){
				$JS.= '"'.$swf_file_post_name_Keys[$i].'" : "'.$this->SWF_file_post_name[$swf_file_post_name_Keys[$i]].'"';
				if ($i!=(count($this->SWF_file_post_name)-1))
				$JS.= ',';
			}
			$JS.= "\n".'},'."\n";
		}
			
			
		$JS.= '// File Upload Settings '."\n";
		$JS.= "\t".'file_size_limit: "'.$this->SWF_file_size_limit.'",'."\n";
		$JS.= "\t".'file_types : "';
		for ($i=0;$i<count($this->SWF_file_types);$i++){
			$JS.= "".''.$this->SWF_file_types[$i].'';
			if ($i!=(count($this->SWF_file_types)-1))
			$JS.= ';';
		}
		$JS.= '",'."\n";
		$JS.= "\t".'file_types_description: "'.$this->SWF_file_types_description.'",'."\n";
		$JS.= "\t".'file_upload_limit: "'.$this->SWF_file_upload_limit.'",'."\n";
		$JS.= "\t".'file_queue_limit: '.$this->SWF_file_queue_limit.','."\n";
			
		$JS.= '//Event Handler Settings - these functions as defined in Handlers.js'."\n";
		$JS.= '//The handlers are not part of SWFUpload but are part of my website and control how'."\n";
		$JS.= '//my website reacts to the SWFUpload events.'."\n";
		$JS.= "\t".'file_queue_error_handler: '.$this->SWF_file_queue_error_handler.','."\n";
		$JS.= "\t".'file_dialog_complete_handler: '.$this->SWF_file_dialog_complete_handler.','."\n";
		$JS.= "\t".'upload_progress_handler: '.$this->SWF_upload_progress_handler.','."\n";
		$JS.= "\t".'upload_error_handler: '.$this->SWF_upload_error_handler.','."\n";
		$JS.= "\t".'upload_success_handler: '.$this->SWF_upload_success_handler.','."\n";
		$JS.= "\t".'upload_complete_handler: '.$this->SWF_upload_complete_handler.','."\n";
		$JS.= "\t".'swfupload_loaded_handler: '.$this->SWF_swfupload_loaded_handler.','."\n";
		$JS.= "\t".'file_dialog_start_handler: '.$this->SWF_file_dialog_start_handler.','."\n";
		$JS.= "\t".'file_queued_handler: '.$this->SWF_file_queued_handler.','."\n";
		//$JS.= 'upload_start_handler: '.$this->SWF_upload_start_handler.','."\n";
		//$JS.= 'debug_handler: '.$this->SWF_debug_handler.','."\n";


		$JS.= '//Flash Settings'."\n";
		$JS.= "\t".'flash_url: "'.$this->SWF_flash_url.'",'."\n";
		$JS.= "\t".'flash_width: "'.$this->SWF_flash_width.'",'."\n";
		$JS.= "\t".'flash_height: "'.$this->SWF_flash_height.'",'."\n";
		$JS.= "\t".'flash_color: "#'.$this->SWF_flash_color.'",'."\n";
			
		$JS.= '//Debug Settings'."\n";
		$JS.= "\t".'debug: '.$this->SWF_debug.''."\n";
			
		//$JS.= 'file_post_name : "'.$this->SWF_file_post_name.'",'."\n";
		/*
		 $JS.= 'custom_settings : {'."\n";
		 $swf_custom_settings_Keys = array_keys($this->SWF_custom_settings);
		 for ($i=0;$i<count($this->SWF_custom_settings);$i++){
		 $JS.= ''.$swf_custom_settings_Keys[$i].' : "'.$this->SWF_custom_settings[$swf_custom_settings_Keys[$i]].'"';
		 if ($i!=(count($this->SWF_custom_settings)-1))
		 $JS.= ',';
		 }
		 $JS.= '}'."\n";
		 */
		$JS.= '});'."\n";
		$JS.= '};'."\n";
		$JS.= '</script>'."\n";
			
		return $JS;
	}


	/**
	 * Crea un agrupamiento HTML mediante fieldSet
	 * para los  nombres de  los campos contenidos
	 * dentro del tercer parametro.
	 *
	 * @param string  $idGroup Identificador interno del fieldSet
	 * @param string  $strFieldSet Legend del fieldSet
	 * @param array   $arraystrIdFields Arreglo de nombre de objetos que seran agrupados
	 * @param integer $intCols Numero de Columnas en el que la tabla se partira
	 * @param boolean $useShowHide Usar o no propiedad para mostrar y ocultar las capas
	 * @param string  $iniVisibilitySts Si se activo la propiedad de mostrar y ocultar el fieldset, determinar el estado inicial 
	 */
	public function addGroup ($idGroup, $strFieldSet, $arraystrIdFields, $intCols = 2, $useShowHide = false, $iniVisibilitySts = 'show'){
		
		$this->arrayGroups[] = array(
			'idGroup' => $idGroup, 
			'strFieldSet' => $strFieldSet, 
			'arraystrIdFields' => $arraystrIdFields, 
			'intColsByGroup' => $intCols,
			'useShowHide' => $useShowHide,
			'iniVisibilitySts' => $iniVisibilitySts
		);

		$this->arrayFormElementsShown = array_merge($this->arrayFormElementsShown, $arraystrIdFields);
	}




	/**
	 * Metodo publico que setea la ubicacion fisica de el servidor
	 * en donde se se van a alojar todos los archivos que sean subidos
	 *
	 * @param string $uploadDirectory  Ruta fisica interna del servidor
	 */
	public function setUploadDirectory($uploadDirectory) {
		if (trim($uploadDirectory) != '' && is_dir($uploadDirectory)) {
			$this->uploadDirectory=trim($uploadDirectory);
		}else {
			die("<b>ERROR:</b> Failed to open Directory: $uploadDirectory");
		}
	}


	/**
	 * Esta funcion retorna un listado de todos los archivos
	 * que en ese momento estan dentro de la carpeta de subida
	 */
	public function getAllUploadedFiles() {
		$returnArray = array();
		$allFiles = $this->scanUploadedDirectory();
		return $returnArray;
	}


	/**
	 * Esta funcion recorre el directorio donde estan los archivos
	 * que se han subido para que sean devueltos por el metodo 'getAllUploadedFiles'
	 */
	private function scanUploadedDirectory() {
		$returnArray = array();
		if ($handle = opendir($this->uploadDirectory)) {
			while (false !== ($file = readdir($handle))) {
				if (is_file($this->uploadDirectory."/".$file)) {
					$returnArray[] = $file;
				}
			}
			closedir($handle);
		}else {
			die("<b>ERROR: </b> Could not read directory: ". $this->uploadDirectory);
		}
		return $returnArray;
	}

	/**
	 * Agregar un evento JavaScript al elemento llamado 'id' que es el elemento que queremos modificar
	 * su propiedad de OnClick, OnBlur... etc
	 * Por ejemplo, podemos crear una caja de texto sencilla por medio de
	 * $obj-> addText('Nombre:','nombre'); y despues agregar el siguiente metodo
	 *
	 * $obj->addEventJs()
	 *
	 * Para que en la obtencion del formulario ese evento sea escrito en la salida HTML
	 *
	 * @param string  $strElementIdORelemlentName  Nombre o id del objeto del formulario al que se le va a agregar un evento Js
	 * @param integer $strEventORintEvent          El metodo que deseamos realizar, puede ser un entero o directamente el nombre del evento
	 * @param string  $strFunctionORarrayFunctions El nombre de la funcion o funciones que deseamos llamar (Ajax) al momento de cumplirse el evento
	 * @param mixed   $mixedMoreParams             Arreglo con otros parametros que uno quiera pasar
	 *
	 * Valores permitidos (1->blur, 2->change, 3->click, 4->focus, 5->mouseout, 6->OnMouseOver)
	 *
	 * Hasta el momento esta metodo solo aplica para los objetos de formularios que sean
	 * -textarea
	 * -select
	 * -password
	 * -text
	 * -radiobuttons
	 * -checkbox
	 */
	public function addEventJs ($strElementIdORelemlentName,$strEventORintEvent,$strFunctionORarrayFunctions, $mixedMoreParams = ''){
		$array_eJs = array (
		1 => ' OnBlur',      'onblur' =>      ' OnBlur',
		2 => ' OnChange',    'onchange' =>    ' OnChange',
		3 => ' OnClick',     'onclick' =>     ' OnClick',
		4 => ' OnFocus',     'onfocus' =>     ' OnFocus',
		5 => ' OnMouseOut',  'onmouseout' =>  ' OnMouseOut',
		6 => ' OnMouseOver', 'onmouseover' => ' OnMouseOver');

		if (is_string($strEventORintEvent))
		$strEventORintEvent = strtolower($strEventORintEvent);
			
		$this->objEventxJ[$strElementIdORelemlentName] .= $array_eJs[$strEventORintEvent].'="';

		if (is_array($strFunctionORarrayFunctions)){
			$cantFinctions = count($strFunctionORarrayFunctions);
			for($i=0;$i<$cantFinctions;$i++){
				$this->objEventxJ[$strElementIdORelemlentName] .= $this->prefAjax.$strFunctionORarrayFunctions[$i].'(GetDataForm(\''.$this->NomForm.'\''.')';
				//Miramos si hay parametros adicionales
				if (!$mixedMoreParams)
				$this->objEventxJ[$strElementIdORelemlentName] .= ')'.'';
				else{
					$this->objEventxJ[$strElementIdORelemlentName] .= ', ';
					 
					$countMoreParams = count ($mixedMoreParams);$k=0;
					foreach($mixedMoreParams as $valParam){
						if (!is_numeric($valParam))
						$valParam = "'".$valParam."'";
						$this->objEventxJ[$strElementIdORelemlentName] .= $valParam;
						if ($k<($countMoreParams-1))
						$this->objEventxJ[$strElementIdORelemlentName] .= ', ';
						$k++;
					}
					$this->objEventxJ[$strElementIdORelemlentName] .=')';
				}
					
				if (($i+1)<$cantFinctions)
				$this->objEventxJ[$strElementIdORelemlentName] .=', ';
			}
			$this->objEventxJ[$strElementIdORelemlentName] .='"';
		}else{
			$this->objEventxJ[$strElementIdORelemlentName] .= $this->prefAjax.$strFunctionORarrayFunctions.'(GetDataForm(\''.$this->NomForm.'\''.')';
			if (!$mixedMoreParams)
			$this->objEventxJ[$strElementIdORelemlentName] .=')'.'" ';
			else{
			 $this->objEventxJ[$strElementIdORelemlentName] .= ', ';
			 $countMoreParams = count ($mixedMoreParams);$i=0;
			 foreach($mixedMoreParams as $valParam){
			 	if (!is_numeric($valParam))
			 	$valParam = "'".$valParam."'";
			 	$this->objEventxJ[$strElementIdORelemlentName] .= $valParam;
			 	if ($i<($countMoreParams-1))
			 	$this->objEventxJ[$strElementIdORelemlentName] .= ', ';
			 	$i++;
			 }
			 $this->objEventxJ[$strElementIdORelemlentName] .=')'.'" ';
			}
		}
	}


	/**
	 * Es llamada en la construccion del formulario para averiguar si en elemento de ese formulario esta
	 * ralacionada con un evento xAjax y de esa forma concatenarlo a la salida final del mismo
	 *
	 * @param string  ObjectForm Id del objeto del formulario que el buscara en el arreglo
	 */
	protected function checkExistEventJs($ObjectForm){
		$return = '';
		$array_keys = array_keys ($this->objEventxJ);

		if (in_array($ObjectForm, $array_keys)) {
			$return = $this->objEventxJ[$ObjectForm];
		}

		return $return;
	}


	/**
	 * Agrega la propiedad 'disabled="disabled"' a el objeto del formulario
	 * que se invoque
	 * @param string id Nombre o id del objeto del formulario al que se le va a agregar la propiedad
	 */
	public function addDisabled ($objName){
		if (!in_array($objName, $this->objDisabled)){
			$this->objDisabled[$objName] = $objName;
		}
	}


	/**
	 * Agrega el elemento a el gurpo de elementos
	 * en general de la aplicacion que  contendra
	 * una capa al pasar el mouse sobre el objeto
	 * mostrando una peque�a o determinada descri
	 * pcion del objeto del formulario con el obj
	 * etivo del que un usuario pueda tener un ni
	 * vel de ayuda para saber a que hace referen
	 * cia determinado campo.
	 *
	 * @param string $objName Nombre o id del Objeto del formulario al que se le va a agregar la ayuda
	 * @param string $strHelp Contenido de la ayuda
	 */
	public function addHelp ($objName, $strHelp){
		if (!in_array($objName, $this->objHelps)){
			$this->objHelps[$objName] = str_replace("'","\\'",str_replace('"',"'",$strHelp));
		}
	}


	/**
	 * Agregar un helper a este campo, solo  aplicando
	 * a los campos del formulario que sean campo tipo
	 * texto.
	 * Nota: Este metodo no funciona como lo hace addHelp
	 * antes de un getText, solo funciona con los addText
	 *
	 * @param String $objName      Nombre o id del objeto del formulario al que se le va a agregar el Helper
	 * @param String $mixedStrings Arreglo que contiene los items del helper que seran mostrados a medida que el usuario escriba en la caja de texto
	 */
	public function addHelper ($objName, $mixedStrings){
		if (!in_array($objName, $this->objHelpers)){
			$this->objHelpers[$objName] = $mixedStrings;
		}
	}


	/**
	 * Es llamada dentro de la construccion del
	 * formulario como un  metodo  que  ayuda a
	 * contruir  los  campos  con  un  atributo
	 * adicional  que  inhabilita  un campo del
	 * formulario  para  que  se  puedan  hacer
	 * eventos sobre el.
	 *
	 * @param string  objName Id del objeto del formulario que el buscara en el arreglo
	 */
	protected function checkIfIsDisabled ($objName){
		$disabledStr = ' disabled="disabled"';
		$return = '';
		if (in_array($objName,$this->objDisabled)){
			$return = $disabledStr;
		}

		return $return;
	}


	/**
	 * Llamada que dentro de la construccion del
	 * formulario verifica si el objeto que   se
	 * esta construyendo tiene adicionada    una
	 * cadena de ayuda relacionada.
	 *
	 * @param string $objName Nombre del objeto del formulario al que esta asociado
	 */
	protected function checkIsHelping ($objName){
		$return = '';
		$arrayKeysObjHelps = array_keys ($this->objHelps);
		if (in_array($objName,$arrayKeysObjHelps)){
			switch ($this->styleTypeHelp){
				case 1:
					$return = ' onmouseover="'.$objName.'.style.cursor=\'help\',Tip(\''.$this->objHelps[$objName].'\',BALLOON, true, ABOVE, true, FADEIN, 300, FADEOUT, 300)" ';//
					break;
				case 2:
					$return = ' onmouseover="'.$objName.'.style.cursor=\'help\',Tip(\''.$this->objHelps[$objName].'\')" ';//
					break;
			}
		}

		return $return;
	}

	/**
	 * Dentro de la llamada de contruccion del
	 * formulario verifica si el objeto que se
	 * esta construyendo tiene asociada un helper
	 * para entonces construirlo y adicionarlo
	 * al campo texto que sera mostrado en el formulario.
	 *
	 * @param string $objName Nombre del objeto del formulario al que esta asociado
	 * @return string
	 */
	protected function checkIsHasHelper ($objName){
		$return = '';
		$arrayKeysObjHelpers = array_keys ($this->objHelpers);
		if (in_array($objName,$arrayKeysObjHelpers)){
			$return .= '<script type="text/javascript">'."\n";
			if (is_array($this->objHelpers[$objName])){
				$return .= 'var '.$objName.'s = new Array (';
				foreach ($this->objHelpers[$objName] as $item){
					$return .= '"'.$item[0].'", ';
				}
				$return = substr($return,0,-2);
				$return .= ');'."\n";
				$return .= 'new AutoSuggest(document.getElementById(\''.$objName.'\'),'.$objName.'s);'."\n";
		   
			}else{
				$arrayTempItems = explode (',',$this->objHelpers[$objName]);
				if (count($arrayTempItems)){
					$return .= 'var '.$objName.'s = new Array (';
					foreach ($arrayTempItems as $item){
						$return .= '"'.trim($item).'", ';
					}
					$return = substr($return,0,-2);
					$return .= ');'."\n";
					$return .= 'new AutoSuggest(document.getElementById(\''.$objName.'\'),'.$objName.'s);'."\n";
				}
			}
			
			$return .= '</script>'."\n";
		}

		return $return;
	}

	/**
	 * Dentro de la llamada de contruccion del  Formulario
	 * pregunta si ese nombre de campo tiene dentro  de el
	 * el caracter ':' para averiguar por el numero entero
	 * que viene despues de el,  ya que ese  numero entero
	 * representa las columnas que va a autocompletar para
	 * hacerse mas grande que los demas campos del formulario.
	 *
	 * Si existe dicho valor o no existe, este metodo guarda
	 * el valor colSpan de acuerdo al nombre del  objeto del
	 * formulario.
	 *
	 * @param string $objName Nombre del campo que va a evaluar
	 */
	private function getColspanRowspan ($objName){
		$rowspan = 0;
		$colspan = 0;
		if (strpos($objName,$this->colSpanIdentifier)){
			$arguments = explode ($this->colSpanIdentifier,$objName);
			$objName = $arguments[0];
			$this->arrayFormElementsColspan[$objName] = $arguments[1];
			if ($arguments[2])
			   $this->arrayFormElementsRowspan[$objName] = $arguments[2];
			else   
			   $this->arrayFormElementsRowspan[$objName] = $rowspan;
		}else{
			$this->arrayFormElementsColspan[$objName] = $colspan;
			$this->arrayFormElementsRowspan[$objName] = $rowspan;
		}
	  
		return $objName;
	}


	/**
	 * Retorna el tipo de elemento que identificamos
	 * con el nombre del Objeto del Formulario.
	 *
	 * @param string $objName Nombre del Objeto
	 * @return string
	 */
	public function getTypeElement($objName){
		return $this->arrayFormElementType[$objName];
	}


	/**
	 * Agrega un boton a la funcionalidad del formulario
	 *
	 * @param string $strName    Nombre del Elemento
	 * @param string $strLabel   Etiqueta o valor del Elemento
	 * @param string $jsFunction Funcion xjx que ejecuta
	 * @param string $strSrcImg  Ruta de la img que lo acompana
	 * 
	 * Nota: Si desea pasar variables adicionales al evento del
	 * boton, debe agregar separado por (:) los valores que necesite
	 * 
	 */
	public function addButton ($strName, $strLabel, $jsFunction = '', $strSrcImg = ''){
		$this->arrayButtonList[] = array('strName'    =>  $strName,
                                         'strLabel'   =>  $strLabel,
                                         'jsFunction' =>  $jsFunction);
		
		$count = count($this->arrayButtonList);
		
		if ($strSrcImg)
		   $this->arrayButtonList[($count-1)]['strSrcImg'] = $GLOBALS['urlProject'].$this->subFolder_inImg.$strSrcImg;  
	}


	/**
	 * Obtiene el html de un boton
	 * necesario para ejecutar los
	 * actions en los  formularios
	 * que son creados por los usu
	 * arios.
	 *
	 * @param string $strName    Nombre del boton
	 * @param string $strLabel   Etiqueta del boton
	 * @param string $jsFunction Funcion xjx que ejecuta
	 * @param string $strSrcImg  Ruta de la img que lo acompana
	 * @return string
	 * 
	 * Nota: Si desea pasar variables adicionales al evento del
	 * boton, debe agregar separado por (:) los valores que necesite	 
	 *  
	 */
	public function getButton ($strName, $strLabel, $jsFunction = '', $strSrcImg = ''){
		$buf = '';

		$buf.='<button '.$this->checkIfIsDisabled($strName).' '.$this->checkIsHelping($strName).' value="'.strip_tags($strLabel).'" class="'.$this->styleClassButtons.'" type="button" name="'.$strName.'" id="'.$strName.'" ';
		if ($jsFunction){
			
			if (stripos($jsFunction,':')!==false){
				
		  		$mixedExtParams = array();
		  		$strMixedParams = '';
		  		
		  		$intCountPrm = count($mixedExtParams = split(':',$jsFunction));
		  		$i = 0;
		  		
		  		foreach ($mixedExtParams as $param){
					
		  			if (!$i)
					   $jsFunction = $param; 	
		  			
		  			if ($jsFunction!=$param){
		  				if (!is_numeric($param))
							$strMixedParams .= '\''.$param.'\'';
						else	
							$strMixedParams .= $param;
		  			}
		  			
		  			if (($i+1)<$intCountPrm){
						$strMixedParams .= ',';
		  			}
		  			
					$i++;					  			
		  		}
		  		
		  	}
			
			if (strpos($jsFunction,'closeWindow'))
				$buf .= ' onclick="'.$this->prefAjax.$jsFunction.'"';
			else
				$buf .= ' onclick="'.$this->prefAjax.$jsFunction.'(GetDataForm(\''.$this->NomForm.'\') '.$strMixedParams.')"';
		}
			
		$buf .= '>';

		if ($strSrcImg)
			$buf .= '<img style="padding-right: 3px; vertical-align: bottom;" src="'.$GLOBALS['urlProject'].$this->subFolder_inImg.$strSrcImg.'" border="0">';
			
		$buf.=$strLabel.'</button>';

		return $buf;
	}


	/**
	 * Agrega una caja de texto
	 *
	 * @param string  $etq       Etiqueta del campo
	 * @param string  $name      Nombre del campo
	 * @param string  $value     Valor incial
	 * @param integer $size      Tamano del campo
	 * @param integer $maxlength Numero maximo de caracteres
	 * @param char    $validacion_numerica (S o N)
	 * @param bool    $CampoFecha (0 o 1) Muestra un boton en el campo que facilita la seleccion de una fecha
	 * @param String  $NameFunctionCallCalendar En caso de que $CampoFecha sea 1, debe pasarse como parametro el nombre de la funcion que abrira el calendar
	 *
	 */
	public function addText($etq = '', $name = '', $value = '', $size = '', $maxlength = '', $validacion_numerica = 'N', $CampoFecha = 0, $NameFunctionCallCalendar = 'CallCalendar'){
		$name     = $this->getColspanRowspan($name);
		$Cadena   = 'text'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value.$this->Separador.$size.$this->Separador.$maxlength.$this->Separador.$validacion_numerica.$this->Separador.$CampoFecha.$this->Separador.$NameFunctionCallCalendar;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'text';
	}

	/**
	 * Devuelve una caja de texto
	 *
	 * @param string $name       Nombre del campo
	 * @param string $value      Valor incial
	 * @param integer $size      Tamano del campo
	 * @param integer $maxlength Numero maximo de caracteres
	 * @param char    $validacion_numerica (S o N)
	 * @param bool    $CampoFecha (0 o 1) Muestra un boton en el campo que facilita la seleccion de una fecha
	 * @param String  $NameFunctionCallCalendar En caso de que $CampoFecha sea 1, debe pasarse como parametro el nombre de la funcion que abrira el calendar
	 *
	 */
	public function getText($name = '', $value = '', $size = '', $maxlength = '', $validacion_numerica = 'N', $CampoFecha = 0, $NameFunctionCallCalendar = ''){
		$this->arrayFormElementType[$name] = 'text';
		$keypress = '';
		$Disabled = '';
		$LauncherCalendar = '';

		if ($validacion_numerica == 'S')
		$keypress = ' onKeyPress="return OnlyNum(event)"';

		if ($CampoFecha){
			$LauncherCalendar = '<button type="button" class="'.$this->styleClass.'" id="Launcher_'.$name.'"  name="Launcher_'.$name.'" onMouseOver="CallCalendar(\''.$name.'\', \''.$this->dateFormatCalendar.'\', \'Launcher_'.$name.'\')" /><img src="'.$GLOBALS['urlProject'].$this->subFolder_inImg.$this->SrcImageCalendarButton.'" border="0"></button>';
			$Disabled = 'readonly';
		}
			
		$buf ='<input '.$this->checkIfIsDisabled($name).' '.$this->checkIsHelping($name).' class="'.$this->styleClass.'" type="text" name="'.$name.'" id="'.$name.'" value="'.$value.'" size="'.$size.'" '.$Disabled.' maxlength="'. $maxlength.'"'.$keypress.'  '.$this->checkExistEventJs($name).'>'.$LauncherCalendar.''."\n";
			
		return $buf;
	}

	/**
	 * Agrega una area de texto
	 *
	 * @param string  $etq       Etiqueta del campo
	 * @param string  $name      Nombre del campo
	 * @param string  $value     Valor incial
	 * @param integer $cols      Numero de columna
	 * @param integer $rows      Numero de fila
	 * @param string  $wrap      Clase y tipo de abrigo
	 *
	 */
	public function addTextArea($etq = '', $name = '', $value = '', $cols = '', $rows = '', $wrap = ''){
		$name     = $this->getColspanRowspan($name);
		$Cadena   = 'textarea'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value.$this->Separador.$cols.$this->Separador.$rows.$this->Separador.$wrap;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'textarea';
	}

	/**
	 * Obtiene una area de texto
	 *
	 * @param string  $name      Nombre del campo
	 * @param string  $value     Valor incial
	 * @param integer $cols      Numero de columna
	 * @param integer $rows      Numero de fila
	 * @param string  $wrap      Clase y tipo de abrigo
	 *
	 */
	public function getTextArea($name = '', $value = '', $cols = '', $rows = '', $wrap = ''){
		$buf = '';
		$buf.=''.''.'<textarea '.$this->checkIsHelping($name).' class="'.$this->styleClass.'" name="'.$name.'" id="'.$name.'" cols="'.$cols.'" rows="'.$rows.'" wrap="'.$wrap.'" '.$this->checkExistEventJs($name).' '.$this->checkIfIsDisabled($name).'>'.$value.'</textarea>'."\n";
		$this->arrayFormElementType[$name] = 'textarea';
		return $buf;
	}


	/**
	 * Agregar un editor fckeditor al fomulario actual
	 *
	 * @param string  $etq            Etiqueta del campo generado por el FCK Editor
	 * @param string  $name           Nombre del campo generado por el FCK Editor
	 * @param string  $value          Valor inicial del campo generado por el FCK Editor
	 */
	public function addFCKeditor ($etq = '', $name = '', $value = ''){
		$name     = $this->getColspanRowspan($name);
		$Cadena   = 'fckeditor'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'fckeditor';
	}


	/**
	 * Agrega un campo de texto Oculto al formulario
	 *
	 * @param string $name      Nombre del campo
	 * @param string $value     Valor incial
	 *
	 */
	public function addHidden($name = '', $value = ''){
		$Cadena   = 'hidden'.$this->Separador.$name.$this->Separador.$value;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'hidden';
	}


	/**
	 * Obtiene un campo Oculto
	 *
	 * @param string $name      Nombre del campo
	 * @param string $value     Valor incial
	 *
	 */
	public function getHidden($name = '', $value = ''){
		$buf = '';
		$buf = '<input type="hidden" id="'.$name.'" name="'.$name.'" value="'.$value.'">'."\n";
		$this->arrayFormElementType[$name] = 'hidden';

		return $buf;
	}


	/**
	 * Agrega una caja de texto tipo password
	 *
	 * @param string $etq       Etiqueta del campo
	 * @param string $name      Nombre del campo
	 * @param string $value     Valor incial
	 * @param string $size      Tamano del campo
	 * @param string $maxlength Numero maximo de caracteres
	 *
	 */
	public function addPassword($etq = '', $name = '', $value = '', $size = '', $maxlength = ''){
		$name     = $this->getColspanRowspan($name);
		$Cadena   = 'password'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value.$this->Separador.$size.$this->Separador.$maxlength;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'password';
	}

	/**
	 * Obtiene una caja de texto tipo password
	 *
	 * @param string $name      Nombre del campo
	 * @param string $value     Valor incial
	 * @param string $size      Tamano del campo
	 * @param string $maxlength Numero maximo de caracteres
	 *
	 */
	public function getPassword($name = '', $value = '', $size = '', $maxlength = ''){

		$buf = '';
		$buf ='<input '.$this->checkIfIsDisabled($name).' '.$this->checkIsHelping($name).' class="'.$this->styleClass.'" type="password" name="'.$name.'" id="'.$name.'" value="'.$value.'" size="'.$size.'" maxlength="'. $maxlength.'" '.$this->checkExistEventJs($name).'>'."\n";
		$this->arrayFormElementType[$name] = 'password';
			
		return $buf;		
	}
	

	/**
	 * Agrega conjunto de select para personalizar un campo fecha
	 *
	 * @param string $etq        Etiqueta del campo
	 * @param string $prefName   Prefijo para el nombre del campo
	 * @param int    $iniValA    Valor inicial para el ano
	 * @param int    $iniValM    Valor inicial del mes
	 * @param int    $iniValD    Valor inicial del dia
	 * @param int    $YearBack   Cantidad de anos atras para cagar el select, Opcional
	 * @param int    $YearFuture Cantidad de anos a futuro para cagar el select, Opcional
	 *
	 */
	public function addDate ($etq = '', $prefName = '', $iniValA = '', $iniValM = '', $iniValD = '', $YearBack = 100, $YearFuture = 20){
		$prefName = $this->getColspanRowspan($prefName);
		$arrMsese = array("1"  => "Enero",       "2" => "Febrero",
                          "3"  => "Marzo",       "4" => "Abril", 
                          "5"  => "Mayo",        "6" => "Junio", 
                          "7"  => "Julio",       "8" => "Agosto", 
                          "9"  => "Septiembre", "10" => "Octubre", 
                          "11" => "Noviembre",  "12" => "Dicembre");

		$strY = '';
		$selected = '';
		for ($i = (date("Y")-$YearBack); $i < (date("Y")+$YearFuture); $i++){
			if ($iniValA == $i)
			$selected = ' selected';
			else
			$selected = '';
			$strY .= "\t\t".'<option value="'.$i.'"'.$selected.' class="'.$this->styleClass.'">'.$i.'</option>'."\n";
		}

		$strM = '';
		for ($i = 0, $keys = array_keys($arrMsese); $i < count($arrMsese); $i++){
			if ($iniValM == $keys[$i])
			$selected = ' selected';
			else
			$selected = '';
			$strM .= "\t\t".'<option value="'.$keys[$i].'"'.$selected.' class="'.$this->styleClass.'">'.$arrMsese[$keys[$i]].'</option>'."\n";
		}


		$strD = '';
		for ($i = 1; $i <= 31; $i++){
			if ($iniValD == $i)
			$selected = ' selected';
			else
			$selected = '';
			$strD .= "\t\t".'<option value="'.$i.'"'.$selected.' class="'.$this->styleClass.'">'.$i.'</option>'."\n";
		}

		$Cadena = 'date'.$this->Separador.$etq.$this->Separador.$prefName.$this->Separador.$strY.$this->Separador.$strM.$this->Separador.$strD;
		$this->Objects['field'][$prefName] = $Cadena;
		$this->arrayFormElementType[$prefName] = 'date';
	}


	/**
	 * Agrega conjunto de select para personalizar un campo fecha
	 *
	 * @param string $etq        Etiqueta del campo
	 * @param string $prefName   Prefijo para el nombre del campo
	 * @param int    $iniValH    Valor inicial para la Hora
	 * @param int    $iniValM    Valor inicial para los minutos
	 *
	 */
	function addTime ($etq = '', $prefName = '', $iniValH = '', $iniValM = ''){
		$prefName = $this->getColspanRowspan($prefName);
		$strH = '';
		$selected = '';
		for ($i = 0; $i < 24; $i++){
			if ($iniValH == $i)
			$selected = ' selected';
			else
			$selected = '';

			if ($i<10)
			$label='0';
			else
			$label='';

			$strH .= "\t\t".'<option value="'.$i.'"'.$selected.'>'.$label.$i.'</option>'."\n";
		}

		$strM = '';
		for ($i = 0; $i < 60; $i+=5){
			if ($iniValM == $i)
			$selected = ' selected';
			else
			$selected = '';

			if ($i<10)
			$label = '0';
			else
			$label = '';

			$strM .= "\t\t".'<option value="'.$i.'"'.$selected.'>'.$label.$i.'</option>'."\n";
		}

		$Cadena = 'time'.$this->Separador.$etq.$this->Separador.$prefName.$this->Separador.$strH.$this->Separador.$strM;
		$this->Objects['field'][$prefName] = $Cadena;
		$this->arrayFormElementType[$prefName] = 'time';
	}


	/**
	 * Agrega conjunto de select para personalizar un campo fecha
	 *
	 * @param string $etq        Etiqueta del campo
	 * @param string $prefName   Prefijo para el nombre del campo
	 * @param int    $iniValH    Valor inicial para la Hora
	 * @param int    $iniValM    Valor inicial para los minutos
	 *
	 */
	public function getTime ($prefName = '', $iniValH = '', $iniValM = ''){
		$strH = "\t\t".'<select '.$this->checkIsHelping($prefName).' name="'.$prefName.'_H" size="1" class="'.$this->styleClass.'">'."\n";
		$selected = '';
		for ($i = 0; $i < 24; $i++){
			if ($iniValH == $i)
			$selected = ' selected';
			else
			$selected = '';

			if ($i<10)
			$label='0';
			else
			$label='';

			$strH .= "\t\t".'<option value="'.$i.'"'.$selected.'>'.$label.$i.'</option>'."\n";
		}
		$strH .= "\t\t".'</select>'."\n";

		$strM = "\t\t".'<select '.$this->checkIsHelping($prefName).' name="'.$prefName.'_M" size="1" class="'.$this->styleClass.'">'."\n";
		for ($i = 0; $i < 60; $i+=1){
			if ($iniValM == $i)
			$selected = ' selected';
			else
			$selected = '';

			if ($i<10)
			$label = '0';
			else
			$label = '';

			$strM .= "\t\t".'<option value="'.$i.'"'.$selected.'>'.$label.$i.'</option>'."\n";
		}
		$strM .= "\t\t".'</select>'."\n";
		$this->arrayFormElementType[$prefName] = 'time';

		return $strH.':'.$strM;
	}


	/**
	 * Agrega un espacio en blanco en el lugar que le corresponda
	 *
	 * @param integer $id    Identificador del espacio, este puede ser un numero consecutivo
	 * @param string  $val_e Valor en el momento del cargue dentro del formulario para la etiqueta
	 * @param string  $val_c Valor en el momento del cargue dentro del formulario para el campo
	 */
	public function addWhiteSpace ($id, $val_e = '', $val_c = ''){
		$id = $this->getColspanRowspan($id);
		$this->Objects['field']['whitespace_'.$id] = 'whitespace'.$this->Separador.$id.$this->Separador.$val_e.$this->Separador.$val_c;
		$this->arrayFormElementType[$id] = 'whitespace';
	}


	/**
	 * Agrega un comentario en una Fila especifica
	 * @param integer $id Identificador del espacio que va a utilizar, este siempre debe de ser diferente para cada uno
	 * @param string  $Coment Texto que desea mostrar en la fila
	 */

	public function addComent ($id, $Coment){
		$id     = $this->getColspanRowspan($id);
		$Cadena = 'coment'.$this->Separador.$id.$this->Separador.$Coment;
		$this->Objects['field']['coment_'.$id] = $Cadena;
		$this->arrayFormElementType[$id] = 'coment';
	}


	/**
	 * Agrega un radio button al formulario en particular.
	 * Los grupos de radio buttons se pueden formar y funcionar
	 * siempre y cuando esos radio buttons queden con el mismo
	 * nombre que permita agruparlos.
	 *
	 * @param Etiqueta $etq
	 * @param Valor    $value
	 * @param Grupo al que pertenece  $name_group
	 * @return string Id del radio button, se usa para poder agrupar mas adelante
	 */
	public function addRadioButton($etq = '', $value = '', $name_group = '', $is_checked = 'N'){
		$name = 'radio_'.$this->counterRediosForThisForm+=1;

		//$name = $this->getColspanRowspan($name);
		$Cadena = 'radiobutton'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value.$this->Separador.$name_group.$this->Separador.$is_checked;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'radiobutton';
			
		return $name;
	}


	/**
	 * Obtiene el html de un radio button
	 *
	 * @param string $value Valor por defecto del Radio button
	 * @param string $name_group Nombre del radio o grupo que van a comformarlo
	 * @return string
	 */
	public function getRadioButton ($value = '', $name_group = '', $is_checked = 'N'){
		$buf = '';

		$checked = '';
		if ($is_checked=='S')
		$checked = 'checked="checked"';

		$buf .= '<input '.$this->checkExistEventJs($name_group).' '.$this->checkIsHelping($name_group).' '.$this->checkIfIsDisabled($name_group).' type="radio" name="'.$name_group.'" id="'.$name_group.'" value="'.$value.'" class="'.$this->styleClass.'" '.$checked.'>';
		unset($this->objEventxJ[$name_group]);
		$this->arrayFormElementType[$name_group] = 'radiobutton';

		return $buf;
	}


	/**
	 * Agrega una caja checkBox al formulario, el contenido de esta caja puede
	 * ser evaluado para verificar si es '0' o '1'
	 *
	 * @param string $etq       Etiqueta del campo
	 * @param string $name      Nombre de checkbox
	 * @param char   $ini_sts   Estado inicial del Check en la carga del formulario. N = No chequeado, S = Chequeado
	 *
	 */
	public function addCheckBox($etq = '', $name = '', $ini_sts = 'N'){
		$name = $this->getColspanRowspan($name);
		$Cadena = 'checkbox'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$ini_sts;
		$this->Objects['field'][$name] = $Cadena;
		$this->arrayFormElementType[$name] = 'checkbox';

	}


	/**
	 * Obtiene una caja checkBox al formulario, el contenido de esta caja puede
	 * ser evaluado para verificar si es '0' o '1'
	 *
	 * @param string $name      Nombre de checkbox
	 * @param char   $ini_sts   Estado inicial del Check en la carga del formulario. N = No chequeado, S = Chequeado
	 *
	 */
	public function getCheckBox($name = '', $ini_sts = 'N'){
		$buf = '';

		$value = '0';
		$cheked = '';
		if ($ini_sts == 'S'){
			$cheked = 'checked';
			$value  = '1';
		}

		$onClickField = 'onclick="Check(\''.$this->NomForm.'\', \''.$name.'\')';
			
		$onEvent = $this->checkExistEventJs($name);
		if ($onEvent){
			if (strpos(strtolower($onEvent),'onclick')){
				$addEvent = substr($onEvent,10,-2);

				$onClickField	.= ','.$addEvent;

				$onEvent = '';
			}
		}
		$onClickField  .= '"';

		$buf .= '<input '.$onEvent.' '.$this->checkIsHelping($name).' class="'.$this->styleClass.'" type="checkbox" name="'.$name.'" id="'.$name.'" value="'.$value.'"  '.$onClickField.'  '.$cheked.' '.$this->checkIfIsDisabled($name).'>'."\n";
		$this->arrayFormElementType[$name] = 'checkbox';

		return $buf;
	}



	/**
	 * Agrega una lista dinamica al formulario para poder seleccionar
	 * uno o varios Registros de esa lista dinamica.
	 *
	 * En construccion
	 *
	 * @param unknown_type $etq
	 * @param unknown_type $name
	 * @param unknown_type $sql
	 * @param unknown_type $idToCheckBox
	 */
	public function addList ($etq = '', $name, $sql, $idToCheckBox){
		if ($sql){
			$objDinamicList = new myDinamicList($name,$sql);

			$objDinamicList->getDinamicList($name,false);
			$objDinamicList->setColumn($name, $idToCheckBox, '',$this->getCheckBox($idToCheckBox));

			$Cadena = 'mylist'.$this->Separador.$name.$this->Separador.$etq;
			$this->Objects['field'][$name] = $Cadena;
		}
	}


	/**
	 * Agrega una combo desplegable (menu)
	 *
	 * @param string $etq       	Etiqueta del campo
	 * @param string $name      	Nombre del campo
	 * @param array  $value     	Valor incial que es un arreglo de la forma especificada
	 * @param string $size      	Tamano del campo
	 * @param string $truncar_hasta Truncar Numero maximo de caracteres al fina
	 *
	 */
	public function addSelect($etq = '', $name = '', $value = '', $selected ='', $size = '', $truncar_hasta = 100, $multiple = 0){
		$name = $this->getColspanRowspan($name);
		$buf  = '';
		if (is_array ($value)){
			if ($this->selectUseFirstValue)
			$buf .= "".'<option value="">'.htmlentities($this->strLabelFirstOptionOnSelect).'</option>'."\n";
			
			$selectedIsArray = false;
			if (is_array($selected)){
			   $selectedIsArray = true;
			}
			
			for ($i=0,$array_keys = array_keys ($value);$i<count ($array_keys); $i++){
				$sel = "";
				if (!$selectedIsArray){
				   if (!strcmp($value[$array_keys[$i]][0],$selected)){
				   	  $sel = " selected";
				   }
				}else{
				   if (in_array($value[$array_keys[$i]][0],$selected)){
				      $sel = " selected";
				   }					
				}
				   
				$buf .= "\t\t".'<option value="'.$value[$array_keys[$i]][0].'"'.$sel.'>'.substr($value[$array_keys[$i]][1],0,$truncar_hasta).'</option>'."\n";
			}

			$buf .= "\t\t".'</select>'."\n";
			$value = $buf;
		}
		$maxlength = '';

		$Cadena   = 'select'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value.$this->Separador.$size.$this->Separador.$maxlength.$this->Separador.$multiple;
		$this->Objects['field'][$name] = $Cadena;

		$this->arrayFormElementType[$name] = 'select';
	}


	/**
	 * Obtiene una combo desplegable (menu)
	 *
	 * @param string $name          Nombre del campo
	 * @param array  $value         Valor incial que es un arreglo de la forma especificada
	 * @param string $size          Tamano del campo
	 * @param string $truncar_hasta Truncar Numero maximo de caracteres al fina
	 *
	 */
	public  function getSelect($name = '', $value = '', $selected ='', $size = '', $truncar_hasta = 100, $multiple = 0){
		$string_multiple = '';
		if ($multiple)
		$string_multiple = ' multiple';
		$buf.= "\t\t".'<select '.$this->checkIfIsDisabled($name).' '.$this->checkIsHelping($name).' class="'.$this->styleClass.'" name="'.$name.'" id="'.$name.'"'.$string_multiple.' size="'.$size.'" '.$this->checkExistEventJs($name).'>'."\n";
			
		if (is_array ($value)){
			if ($this->selectUseFirstValue)
			$buf .= "\t\t".'<option value="">'.htmlentities($this->strLabelFirstOptionOnSelect).'</option>'."\n";

			$selectedIsArray = false;
			if (is_array($selected)){
			   $selectedIsArray = true;
			}	
			
			for ($i=0,$array_keys = array_keys ($value);$i<count ($array_keys); $i++){
				$sel = "";
				if (!$selectedIsArray){
				  if (!strcmp($value[$array_keys[$i]][0],$selected)){
				     $sel = " selected";
				  }
				}else{    
				  if (in_array($value[$array_keys[$i]][0],$selected)){
				     $sel = " selected";
				  }
				}
				$buf .= "\t\t".'<option value="'.$value[$array_keys[$i]][0].'"'.$sel.'>'.htmlentities(substr($value[$array_keys[$i]][1],0,$truncar_hasta)).'</option>'."\n";
			}

			$buf .= '</select>'."\n";
		}

		$this->arrayFormElementType[$name] = 'select';

		return $buf;
	}

	/**
	 * Agrega   un  campo   de  tipo  file
	 * asincronico a el formulario actual.
	 *
	 * @param string  $etq                     Etiqueta del campo
	 * @param string  $name                    Nombre del campo
	 * @param string  $upload_url              Url del .php que recibe los datos
	 * @param string  $flash_url               Url del donde se encuentra ubicado el flash
	 * @param array   $file_types              Arreglo con los tipos de archivos que se pueden subir
	 * @param string  $file_types_description  Descripcion de los tipos de archivos que se pueden subir
	 * @param integer $file_size_limit         Limite de tamano por archivo que se puede subir
	 */
	public function addFile ($etq, $name, $upload_url, $flash_url, $file_types = '', $file_types_description = '', $file_size_limit = ''){
		$name = $this->getColspanRowspan($name);
		if ($file_types && is_array($file_types))
		$this->SWF_file_types = $file_types;
			
		if ($file_types_description)
		$this->SWF_file_types_description = $file_types_description;
			
		if (intval($file_size_limit))
		$this->SWF_file_size_limit = $file_size_limit;

		$this->SWF_upload_url = $upload_url;
		$this->SWF_flash_url  = $flash_url;

		$Cadena   = 'file'.$this->Separador.$etq.$this->Separador.$name.$this->Separador.$value;
		$this->Objects['field'][$name] = $Cadena;
		$this->uploaderIdArray[] = $name;

		$this->arrayFormElementType[$name] = 'file';
		$this->useAddFile = true;
	}



	/**
	 * Obtiene el HTML de un campo formulario
	 * tipo File asincronico.
	 *
	 * @param string $name Nombre del campo
	 * @return string
	 */
	public function getFile ($name){
		$buf = '';

		if ($this->SWF_upload_several_files == true)
		$SWFonClick = "swfu.selectFiles();";
		else
		$SWFonClick = "swfu.selectFile();";

		$buf.='<button '.$this->checkIfIsDisabled($name).' '.$this->checkIsHelping($name).' class="'.$this->styleClassButtons.'" id="'.$name.'" type="button"  onclick="'.$SWFonClick.'">';
		
		if ($this->SWF_src_img_button)
		   $buf.='<img style="padding-right: 3px; vertical-align: bottom;" src="'.$GLOBALS['urlProject'].$this->subFolder_inImg.$this->SWF_src_img_button.'" border="0">';
		
		$maxInfoSize = '';   
	    if ($this->SWF_show_max_upload_size_info_in_button){
	    	if ($this->SWF_file_size_limit<1024){
	           $maxFileSizeUpload = '('.$this->SWF_file_size_limit.' Kb)';
	    	}else if ($this->SWF_file_size_limit<1048576){
	    	   $maxFileSizeUpload = '('.number_format($this->SWF_file_size_limit/1024,2).' Mb)';
	    	}else{
      		   $maxFileSizeUpload = '('.number_format($this->SWF_file_size_limit/1048576,2).' Gb)';
	    	}
	       $maxInfoSize = '<font style="vertical-align: middle; font-size: 6pt; font-weight: bold;">'.$maxFileSizeUpload.'</font>';
	    }	   
		   
		$buf.=$this->SWF_str_etq_button.$maxInfoSize."</button><div style=\"text-align: left;\" class=\"".$this->styleClassTags."\" id=\"div_file_progress\" name=\"div_file_progress\"></div>";
		$this->arrayFormElementType[$name] = 'file';

		return $buf;
	}


	/**
	 * Obtiene informacion de los campos que aun no estan validados
	 * Ejemplo de arrayRequeridos $arrayRequeridos = array ('nombre_campo'=>'Etiqueta campo');
	 * Nota: Preguntar por $this->errorValidacion para obtener un String de los campos incompletos
	 *
	 * @param array $arrayRequeridos Arreglo de datos que son obligatorios
	 * @param array $FormElements 	 Arreglo retornado por $this->DataFormToArray($dataForm);
	 * @return bool
	 */
	public function validateForm($arrayRequeridos, $FormElements){
		$this->arrayRequiredFiled = $arrayRequeridos;

		$valido= true;
		$llavesRequeridos = array_keys($arrayRequeridos);
		for ($i=0;$i<count($arrayRequeridos);$i++){
			if (!trim($FormElements[$llavesRequeridos[$i]])){
				$valido = false;
				$this->errorValidacion .= '* '.$arrayRequeridos[$llavesRequeridos[$i]]."\n";
			}

		}
		return $valido;
	}


	/**
	 * Retorna el objeto del formulario como una cadena String que cumple
	 * las veces del metodo getForm, solo que aqui no es posible pasar por
	 * objeto el numero de columnas del formulario. Para hacerlo se debe pre
	 * viamente configurar el el atributo $this->Cols antes de retornar el
	 * objeto.
	 *
	 * @param integer $cols Numero de columnas que tiene el formulario
	 * @return string
	 */
	public function __toString ($cols = ''){
		if ($cols)
		$this->Cols = $cols;

		$buf = '';
		if ($this->use_cache){
			if (file_exists($this->cache_dir)){
				
				if (file_exists($fileForm = $this->cache_dir.$this->NomForm.'___DATA___'.$this->cache_int_seconds_time.$this->cache_ext_file)){
					$arrayNomForm = split( '___', strrev($fileForm));

					list($H,$i,$s) = split(':',date("H:i:s",filemtime($fileForm)));
					$timeStampSecCreated = ($H*3600)+($i*60)+$s;
					
					list($H,$i,$s) = split(':',date("H:i:s"));
					$timeStampSecNow     = ($H*3600)+($i*60)+$s;

					if (($difer = $timeStampSecNow-$timeStampSecCreated)<= ($cacheSeconds = intval(strrev($arrayNomForm[0])))){
						$fileGestor = fopen($fileForm,'r');
						$fileContenido = fread($fileGestor,filesize($fileForm));
						fclose($fileGestor);
					}else{
						$fileGestor = fopen($fileForm,'w');
						fwrite($fileGestor,$fileContenido = $this->compileForm($this->Cols));
						fclose($fileGestor);
					}

				}else{
					$fileGestor = fopen($fileForm,'w');
					fwrite($fileGestor,$fileContenido = $this->compileForm($this->Cols));
					fclose($fileGestor);
				}
				
			}else{
				mkdir ($this->cache_dir,0777);
			}
			
		}else{
			$fileContenido = $this->compileForm($this->Cols);
		}
		
		return $fileContenido;
	}


	/**
	 * Imprime el formulario final
	 *
	 * @param integer $cols Numero de columnas
	 */
	public function showForm($cols = 2){
		print $this->__toString($cols);
	}


	/**
	 * Obtiene el HTML de un formulario previamente configurado
	 *
	 * @param integer $cols Numero de columnas que tiene el formulario
	 * @return string
	 */
	public function getForm($cols = 2){
		return $this->__toString($cols);
	}


	/**
	 * Agrupa grupos de elementos previamente definidos
	 * para dejar un cojunto de grupos en una fila y no
	 * para que queden en filas separadas.
	 *
	 * @param string $idGroupingGroups Id del grupo de grupos
	 */
	public function shareSpaceForGroups ($arrayIdGroups){
		$this->arrayGroupsIdInShareSpace[] = array('arrayIdGroups' => $arrayIdGroups);
	}


	/**
	 * Compila el formulario de acuerdo con los
	 * parametros seleccionados previos.
	 *
	 * @param integer $intCols Numero de columnas
	 * @return string
	 */
	private function compileForm ($cols){
		$buf = ''."\n";

		$buf .= '<!--'."\n";
		$buf .= 'OSEZNO FRAMEWORK'."\n";
		$buf .= 'Generado con la clase para la creacion de Formularios myForm.class.php'."\n";
		$buf .= 'Nombre de Formulario: '.$this->NomForm.''."\n";
		$buf .= 'Autor: Jose Ignacio Gutierrez Guzman -  joselitohacker@yahoo.es'."\n";
		$buf .= 'Version de la Clase:'.$this->Version."\n";
		$buf .= '-->'."\n";

		if ($this->useAddFile)
		  $buf .= $this->getJavaScriptSWFUploader();
		
		$buf .= '<div align="center" id="div_'.$this->NomForm.'" name="div_'.$this->NomForm.'">'."\n";

		if (strlen($this->strNameFieldSet))
			$buf .= '<fieldset><legend class="'.$this->styleClassFieldsets.'">'.$this->strNameFieldSet.'</legend>'."\n";

		$this->Cols = $cols;

		$buf .= '<form ';

		if ($this->Action)
			$buf .= 'action="'.$this->Action.'" ';

		$buf.= 'method="'.$this->Method.'" ';

		if(!$this->Action)
			$buf.= 'onsubmit="'.$this->onSubmitAction.'" ';

		if($this->jsFunctionEvent && $this->Action)
		$buf.= 'onsubmit="'.$this->onSubmitAction.'" ';
			
		if ($this->Enctype)
			$buf.='enctype= "'.$this->Enctype.'" ';
			
		$buf.= 'name="'.$this->NomForm.'" id="'.$this->NomForm.'" target="'.$this->Target.'">'."\n";


		// Capa necesaria para ejecutar los helpers
		if (count($this->objHelpers))
			$buf .= '<div id="autosuggest"><ul></ul></div>';

		/**
		 * Creamos cada uno de los Objetos HTML
		 * con el objetivo de que mas adelante sean procesados en:
		 * Grupos, o Independientemente. No olvidar que los grupos
		 * pueden ser reagrupados en super grupos.
		 */
		$ObjectKeys = array_keys($this->Objects);
		$countObjects = count($this->Objects['field']);
		for($j=0, $objKeysFields = array_keys($this->Objects['field']); $j < $countObjects; $j++){
			$campos_f = split ($this->Separador,$this->Objects['field'][$objKeysFields[$j]]);
			switch ($campos_f[0]){
				case 'text':// Ok colSpan
					$keypress = '';
					if ($campos_f[6] == 'S')
					$keypress = ' onKeyPress="return OnlyNum(event)"';

					$Disabled = '';
					$LauncherCalendar = '';
					if ($campos_f[7]){
						$LauncherCalendar = '<button type="button" class="'.$this->styleClass.'" id="Launcher_'.$campos_f[2].'"  name="Launcher_'.$campos_f[2].'" onMouseOver="CallCalendar(\''.$campos_f[2].'\', \''.$this->dateFormatCalendar.'\', \'Launcher_'.$campos_f[2].'\')" /><img src="'.$GLOBALS['urlProject'].$this->subFolder_inImg.$this->SrcImageCalendarButton.'" border="0"></button>';
						$Disabled = 'readonly';
					}
						
					$this->arrayFormElements[$campos_f[2]] = '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld><input '.$this->checkIsHelping($campos_f[2]).' class="'.$this->styleClass.'" type="text" name="'.$campos_f[2].'" id="'.$campos_f[2].'" value="'.$campos_f[3].'" size="'.$campos_f[4].'" '.$Disabled.' maxlength="'.$campos_f[5].'"'.$keypress.''.$this->checkExistEventJs($campos_f[2]).''.$this->checkIfIsDisabled($campos_f[2]).'>'.$this->checkIsHasHelper($campos_f[2]).$LauncherCalendar.'</td>'."\n";
					break;
				case 'password':
					$this->arrayFormElements[$campos_f[2]] = '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld><input '.$this->checkIsHelping($campos_f[2]).' class="'.$this->styleClass.'" type="password" name="'.$campos_f[2].'" id="'.$campos_f[2].'" value="'.$campos_f[3].'" size="'.$campos_f[4].'" maxlength="'.$campos_f[5].'" '.$this->checkExistEventJs($campos_f[2]).' '.$this->checkIfIsDisabled($campos_f[2]).'></td>'."\n";
					break;
				case 'file':
					$bufTemp = '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld>';

					if ($this->SWF_upload_several_files == true)
					$SWFonClick = "swfu.selectFiles();";
					else
					$SWFonClick = "swfu.selectFile();";

					$bufTemp .= '<button '.$this->checkIfIsDisabled($campos_f[2]).' '.$this->checkIsHelping($campos_f[2]).' class="'.$this->styleClassButtons.'" id="'.$campos_f[2].'" type="button"  onclick="'.$SWFonClick.'">';

					if ($this->SWF_src_img_button)
					$bufTemp .= '<img style="padding-right: 3px; vertical-align: bottom;" src="'.$GLOBALS['urlProject'].$this->subFolder_inImg.$this->SWF_src_img_button.'" border="0">';

					$maxInfoSize = '';   
	    			if ($this->SWF_show_max_upload_size_info_in_button){
	    				if ($this->SWF_file_size_limit<1024){
	           				$maxFileSizeUpload = '('.$this->SWF_file_size_limit.' Kb)';
	    				}else if ($this->SWF_file_size_limit<1048576){
	    	   				$maxFileSizeUpload = '('.number_format($this->SWF_file_size_limit/1024,2).' Mb)';
	    				}else{
      		   				$maxFileSizeUpload = '('.number_format($this->SWF_file_size_limit/1048576,2).' Gb)';
	    				}
	       				$maxInfoSize = '<font style="vertical-align: middle; font-size: 6pt; font-weight: bold;">'.$maxFileSizeUpload.'</font>';
	    			}	   
					
					$bufTemp .= $this->SWF_str_etq_button.$maxInfoSize.'</button><div style="text-align: left;" class="'.$this->styleClassTags.'" id="div_file_progress" name="div_file_progress"></div>';
					$bufTemp .= '</td>'."\n";

					$this->arrayFormElements[$campos_f[2]] = $bufTemp;
					break;
				case 'select':
					$multiple = '';
					if ($campos_f[6])
					$multiple = ' multiple';
					$this->arrayFormElements[$campos_f[2]] = '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld>'."\n\t\t".'<select '.$this->checkIsHelping($campos_f[2]).' class="'.$this->styleClass.'" name="'.$campos_f[2].'" id="'.$campos_f[2].'"'.$multiple.' size="'.$campos_f[4].'" '.$this->checkExistEventJs($campos_f[2]).' '.$this->checkIfIsDisabled($campos_f[2]).'>'."\n\t\t".$campos_f[3]."\t\t".'</td>'."\n";
					break;
				case 'hidden':
					$this->arrayFormElements[$campos_f[1]] = '<td rowSpanEtq colSpanEtq widthEtq>'.'<input type="hidden" name="'.$campos_f[1].'" id="'.$campos_f[1].'" value="'.$campos_f[2].'">'.'</td><td rowSpanFld colSpanFld widthFld>'."&nbsp;".'</td>'."\n";
					break;
				case 'textarea':
					$this->arrayFormElements[$campos_f[2]] = '<td rowSpanEtq style="text-align:center" colSpanEtq  class="'.$this->styleClassTags.'">'.$campos_f[1].'<br>'.
                    ''.'<textarea '.$this->checkIsHelping($campos_f[2]).' class="'.$this->styleClass.'" name="'.$campos_f[2].'" id="'.$campos_f[2].'" cols="'.$campos_f[4].'" rows="'.$campos_f[5].'" wrap="'.$campos_f[6].'" '.$this->checkExistEventJs($campos_f[2]).' '.$this->checkIfIsDisabled($campos_f[2]).'>'.$campos_f[3].'</textarea></td>'."\n";					 
					break;
				case 'fckeditor':
					$oFCKeditor = new FCKeditor($campos_f[2]) ;
					$oFCKeditor->BasePath = $this->FCK_editor_BasePath;
					$oFCKeditor->Value = $campos_f[3];

					$oFCKeditor->Width  = $this->FCK_editor_Width;
					$oFCKeditor->Height = $this->FCK_editor_Height;

					$oFCKeditor->Config['AutoDetectLanguage']	= false ;
					$oFCKeditor->Config['DefaultLanguage']    = $this->FCK_editor_Laguage;
					$oFCKeditor->ToolbarSet  = $this->FCK_editor_ToolbarSet;

					$this->arrayFormElements[$campos_f[2]] = ''.'<td rowSpanEtq '.$this->checkIsHelping($campos_f[2]).' style="text-align:center" colSpanEtq class="'.$this->styleClassTags.'">'.$campos_f[1]."<br>".$oFCKeditor->CreateHtml().'</td>'."\n";
					break;
				case 'mylist':
					//$objDinamicList->STYLE_color_borde = $this->MYLIST_color_borde;
					//$objDinamicList->STYLE_color_fila_del_medio = $this->MYLIST_color_fila_del_medio;
					//$objDinamicList->STYLE_color_fila_defecto = $this->MYLIST_color_fila_defecto;
					//$objDinamicList->STYLE_color_cabeza_columna = $this->MYLIST_color_cabeza_columna;
					//$objDinamicList->STYLE_color_columna_seleccionada = $this->MYLIST_color_columna_seleccionada;
					//$objDinamicList->STYLE_usar_distincion_filas = $this->MYLIST_usar_distincion_filas;
					//$objDinamicList->STYLE_color_cabeza_columna = $this->MYLIST_estilo_cabeza_columnas;
					//$objDinamicList->STYLE_estilo_enlaces = $this->MYLIST_estilo_enlaces;
					//$objDinamicList->STYLE_estilo_datos = $this->MYLIST_estilo_datos;
					//$objDinamicList->STYLE_titulo_formulario_parametros = $this->MYLIST_titulo_formulario_parametros;
					//$objDinamicList->STYLE_ancho_lista = $this->MYLIST_ancho_lista;

					//$buf.=''.'<tr><td style="text-align:center" colspan="'.($this->arrayGroups[$kAgrupa]['intColsByGroup']*2).'"  class="'.$this->styleClassTags.'">'.$campos_f[2].'</th></tr>'."\n";
					//$buf.=''.'<tr><td style="text-align:center" colspan="'.($this->arrayGroups[$kAgrupa]['intColsByGroup']*2).'">'.$objDinamicList->getDinamicList($campos_f[1],false).'</td></tr>'."\n";
					break;
				case 'date':
					$bufTemp = '';
					$bufTemp .= '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld '.$this->checkIsHelping($campos_f[2]).'>'."\n\t\t".'<select class="'.$this->styleClass.'" name="'.$campos_f[2].'_Y" id="'.$campos_f[2].'_Y" '.$this->checkIfIsDisabled($campos_f[2]).'>'.$campos_f[3].'</select>/'."\t\t\n\t\t".'<select class="'.$this->styleClass.'" name="'.$campos_f[2].'_M" id="'.$campos_f[2].'_M" '.$this->checkIfIsDisabled($campos_f[2]).'>'.$campos_f[4].'</select>/'."\t\t\n\t\t".'<select class="'.$this->styleClass.'" name="'.$campos_f[2].'_D" id="'.$campos_f[2].'_D" '.$this->checkIfIsDisabled($campos_f[2]).'>'.$campos_f[5].'</select></td>'."\n";

					$this->arrayFormElements[$campos_f[2]] = $bufTemp;
					break;
				case 'whitespace':
					$this->arrayFormElements[$campos_f[1]] = '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq><div name="e_'.$campos_f[1].'" id="e_'.$campos_f[1].'">'.$campos_f[2].'</div></td><td rowSpanFld colSpanFld widthFld class="'.$this->styleClass.'"><div name="c_'.$campos_f[1].'" id="c_'.$campos_f[1].'">'.$campos_f[3].'</div></td>'."\n";
					break;
				case 'coment':
					$this->arrayFormElements[$campos_f[1]] = '<td  rowSpanEtq class="'.$this->styleClass.'" colSpanEtq>'.$campos_f[2].'</td>';
					break;
				case 'checkbox':
					$value = '0';
					$cheked = '';

					if ($campos_f[3] == 'S'){
						$cheked = 'checked';
						$value  = '1';
					}

					$onClickTag   = 'onclick="checkear(\''.$this->NomForm.'\', \''.$campos_f[2].'\'), Check(\''.$this->NomForm.'\', \''.$campos_f[2].'\')';
					$onClickField = 'onclick="Check(\''.$this->NomForm.'\', \''.$campos_f[2].'\')';
						
					$onEvent = $this->checkExistEventJs($campos_f[2]);
					if ($onEvent){
						if (strpos(strtolower($onEvent),'onclick')){
							$addEvent = substr($onEvent,10,-2);
							 
							$onClickTag .= ','.$addEvent;
							$onClickField	.= ','.$addEvent;

							$onEvent = '';
						}
					}
						
					$onClickTag    .= '"';
					$onClickField  .= '"';
						
					$this->arrayFormElements[$campos_f[2]] = '<td rowSpanEtq colSpanEtq '.$onClickTag.' '.$onEvent.' class="'.$this->styleClassTags.'"  widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld><input '.$onClickField.' '.$onEvent.' '.$this->checkIsHelping($campos_f[2]).' class="'.$this->styleClass.'" type="checkbox" name="'.$campos_f[2].'" id="'.$campos_f[2].'" value="'.$value.'"   '.$cheked.' '.$this->checkIfIsDisabled($campos_f[2]).'>'.'</td>'."\n";
					break;
				case 'time':
					$bufTemp = '';
					$bufTemp .= '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld '.$this->checkIsHelping($campos_f[2]).' widthFld>'."\n\t\t".'<select class="'.$this->styleClass.'" name="'.$campos_f[2].'_H" id="'.$campos_f[2].'_H" size="1" '.$this->checkExistEventJs($campos_f[2]).' '.$this->checkIfIsDisabled($campos_f[2]).'>'.$campos_f[3].'</select>:'."\n\t\t".'<select class="'.$this->styleClass.'" name="'.$campos_f[2].'_M" id="'.$campos_f[2].'_M" size="1" '.$this->checkExistEventJs($campos_f[2]).' '.$this->checkIfIsDisabled($campos_f[2]).'>'.$campos_f[4].'</select>'.'</td>'."\n";

					$this->arrayFormElements[$campos_f[2]] = $bufTemp;
					break;
				case 'radiobutton':

					$cheked = '';
					if ($campos_f[5] == 'S')
					$cheked = 'checked';

					$this->arrayFormElements[$campos_f[2]] = '<td rowSpanEtq colSpanEtq class="'.$this->styleClassTags.'" widthEtq>'.$campos_f[1].'</td>'.'<td rowSpanFld colSpanFld widthFld><input '.$this->checkIsHelping($campos_f[4]).' class="'.$this->styleClass.'" type="radio" name="'.$campos_f[4].'" id="'.$campos_f[4].'" value="'.$campos_f[3].'" '.$this->checkExistEventJs($campos_f[4]).' '.$this->checkIfIsDisabled($campos_f[4]).' '.$cheked.'></td>'."\n";
					break;
			}
		}

		/**
		 * Creamos el HTML de cada unos de lo grupos que agrupan campos
		 */
		$countArrayGroups = count($this->arrayGroups);
		for ($kAgrupa = 0; $kAgrupa < $countArrayGroups; $kAgrupa++){
			$bufHTMLgroup = '';
			$bufHTMLgroup.= '';
			
			$hrefUseShowHideIni = '';
			$hrefUseShowHideEnd = '';
			$styleDivFieldSet = '';
			
			if ($this->arrayGroups[$kAgrupa]['useShowHide']){
				
				$hrefUseShowHideIni = '<a href="javascript:void(MostrarEsconderFieldSet(\''.$this->arrayGroups[$kAgrupa]['idGroup'].'\'))">';
				$hrefUseShowHideEnd = '</a>';
				
				switch ($this->arrayGroups[$kAgrupa]['iniVisibilitySts']){
					case 'show':
						$styleDivFieldSet = ' style="display:\'\';"';
						break;
					case 'hide':
						$styleDivFieldSet = ' style="display: none;"';
						break;
				}
			}
			
			$bufHTMLgroup .= '<fieldset><legend class="'.$this->styleClassFieldsets.'">'.$hrefUseShowHideIni.$this->arrayGroups[$kAgrupa]['strFieldSet'].$hrefUseShowHideEnd.'</legend>'."\n";
			$bufHTMLgroup .= '<div name="'.$this->arrayGroups[$kAgrupa]['idGroup'].'" id="'.$this->arrayGroups[$kAgrupa]['idGroup'].'"'.$styleDivFieldSet.'>'."\n";
			
			//  Preguntamos si el grupo en proceso es un arreglo de elementos
			if (is_array($this->arrayGroups[$kAgrupa])){
				$bufHTMLgroup .= '<table class="'.$this->styleClassTableForm.'" border="'.$this->tableBorder.'" align="center" cellpadding="'.$this->formCellpadding.'" cellspacing="'.$this->formCellspacing.'" valign="top" width="100%">'."\n";
				$kCamposDe = count($this->arrayGroups[$kAgrupa]['arraystrIdFields']);
				// Calculamos cuantos filas y columna tendra este marco
				$widthCol = intval(100/($this->arrayGroups[$kAgrupa]['intColsByGroup']*2));
				# Numero de filas
				$cantCamposInGroup = count($this->arrayGroups[$kAgrupa]['arraystrIdFields']);

				$iTemp = 0;
				$numColSpan = 0;
				$cantTr = 0;
				$sumNumColSpan = 0;
				for ($i = 0; $i < $cantCamposInGroup; $i++){
						
					$nameField = $this->arrayGroups[$kAgrupa]['arraystrIdFields'][$i];

					if (!(($iTemp)%$this->arrayGroups[$kAgrupa]['intColsByGroup']) || !$iTemp){
						$htmlUseRowSeparator = '';
						if ($this->useRowSeparator){
							if (!(($cantTr+2)%2))
							$htmlUseRowSeparator = 'class = "'.$this->styleClassRowSeparator.'"';
						}
							
						$bufHTMLgroup .= "\t".'<tr '.$htmlUseRowSeparator.'>'."\n";
						$cantTr++;
					}

					if ($this->arrayFormElementsColspan[$nameField]){
						$numColSpan = $this->arrayFormElementsColspan[$nameField];
						$iTemp += $numColSpan;
						$sumNumColSpan += $numColSpan;
					}else{
						$numColSpan = 0;
						$iTemp++;
						$sumNumColSpan ++;
					}
						
					$attObj = $this->arrayFormElementType[$nameField];
					if ($numColSpan){
						switch($attObj){
							case 'textarea':
								$bufHTMLgroup .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
								                  array('width="'.intval($widthCol*$numColSpan).'%"','width="'.intval($widthCol*$numColSpan).'%"','colspan="'.($numColSpan*2).'"','colspan="'.($numColSpan*2).'"','',''),$this->arrayFormElements[$nameField]);
								break;
							default:
								$bufHTMLgroup .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
								                  array('width="'.intval($widthCol*$numColSpan).'%"','width="'.intval($widthCol*$numColSpan).'%"','colspan="'.$numColSpan.'"','colspan="'.$numColSpan.'"','',''),$this->arrayFormElements[$nameField]);
								break;
						}
					}else{
						switch($attObj){
							case 'textarea':
								$bufHTMLgroup .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
								                  array('width="'.intval($widthCol).'%"','width="'.intval($widthCol).'%"','colspan="2"','colspan="2"','',''),$this->arrayFormElements[$nameField]);
								break;
							default:
								$bufHTMLgroup .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
								                  array('width="'.intval($widthCol).'%"','width="'.intval($widthCol).'%"','','','',''),$this->arrayFormElements[$nameField]);
								break;
						}
					}
						
					if (!(($iTemp)%$this->arrayGroups[$kAgrupa]['intColsByGroup']) && $iTemp){
						$bufHTMLgroup .= "\t".'</tr>'."\n";
					}
				}

				//Calculamos las que faltan para completar el combo
				$tdFaltan = ($cantTr*$this->arrayGroups[$kAgrupa]['intColsByGroup'])-$sumNumColSpan;

				if ($tdFaltan){
					for ($i = 0; $i < $tdFaltan; $i++){
						$bufHTMLgroup .= "\t\t".'<td class="'.$this->styleClassTags.'">&nbsp;</td><td class="'.$this->styleClassTags.'">&nbsp;</td>'."\n";
					}
					$bufHTMLgroup .= "\t".'</tr>'."\n";
				}


				$bufHTMLgroup .= '</table>'."\n";
			}else{
				$bufHTMLgroup .= '';
			}
			
			$bufHTMLgroup .= '</div>'."\n";
			$bufHTMLgroup .= '</fieldset>'."\n\n";
			
			$this->arrayGroupsElementsHTML[$this->arrayGroups[$kAgrupa]['idGroup']] = $bufHTMLgroup;
		}


		/**
		 * Recorrer cada unos de los grupos que agrupan
		 * grupos de campos para poder dividirlos.
		 */
		$countarrayGroupsIdInShareSpace = count ($this->arrayGroupsIdInShareSpace);
		$arrayKeysGroupingGroups  = array_keys($this->arrayGroupsIdInShareSpace);
		for ($i=0;$i<$countarrayGroupsIdInShareSpace;$i++){
			// Pregunta de seguridad
			if (is_array($arrayGroupsIdInShareSpace = $this->arrayGroupsIdInShareSpace[$arrayKeysGroupingGroups[$i]]['arrayIdGroups'])){
				$buf .= '<table width="100%" border="'.$this->tableBorder.'" cellspacing="0">'."\n";
				$buf .= '<tr>'."\n";
				for ($j=0;$j<count($arrayGroupsIdInShareSpace);$j++){
					$buf.='<td width="'.intval(100/count($arrayGroupsIdInShareSpace)).'%">'.$this->arrayGroupsElementsHTML[$arrayGroupsIdInShareSpace[$j]].'</td>'."\n";
					$this->arrayGroupsShown[]=$arrayGroupsIdInShareSpace[$j];
				}
				$buf .= '</tr>'."\n";
				$buf .= '</table>'."\n";
			}
		}


		/**
		 * Mostrar cada uno de los grupos que no han sido mostrados
		 */
		for ($i=0;$i<$countArrayGroups;$i++){
			if (!in_array($this->arrayGroups[$i]['idGroup'],$this->arrayGroupsShown)){
				$buf .= $this->arrayGroupsElementsHTML[$this->arrayGroups[$i]['idGroup']];
				$this->arrayGroupsShown[]=$this->arrayGroups[$i]['idGroup'];
			}
		}

		// Calculamos los Id de los objectos definidos del formulario que no han sido definidos
		$countArrayFormElements = count($this->arrayFormElements);
		$arrayKeysFormElements = array_keys($this->arrayFormElements);
		for ($i=0;$i<$countArrayFormElements;$i++){
			if (!in_array($arrayKeysFormElements[$i],$this->arrayFormElementsShown)){
				$this->arrayFormElementsToShow[] = $arrayKeysFormElements[$i];
			}
		}

		// Imprimimos los elementos del formulario restantes
		$buf .= '<table border="'.$this->tableBorder.'" align="center" cellpadding="'.$this->formCellpadding.'" cellspacing="'.$this->formCellspacing.'" valign="top" width="'.$this->formWidth.'" height="'.$this->formHeight.'">'."\n";
		$widthCol = intval(100/($this->Cols*2));
		$cantCamposToShow = count($this->arrayFormElementsToShow);

		$iTemp = 0;
		$numColSpan = 0;
		$cantTr = 0;
		$sumNumColSpan = 0;
		for ($i = 0; $i < $cantCamposToShow; $i++){
				
			
			$nameField = $this->arrayFormElementsToShow[$i];

			if (!(($iTemp)%$this->Cols) || !$iTemp){
				$htmlUseRowSeparator = '';
				if ($this->useRowSeparator){
					if (!(($cantTr+2)%2))
					$htmlUseRowSeparator = ' class = "'.$this->styleClassRowSeparator.'"';
				}
					
				$buf .= "\t".'<tr'.$htmlUseRowSeparator.'>'."\n";
				$cantTr++;
			}

			if ($this->arrayFormElementsColspan[$nameField]){
				$numColSpan = $this->arrayFormElementsColspan[$nameField];
				$iTemp += $numColSpan;
				$sumNumColSpan += $numColSpan;
			}else{
				$numColSpan = 0;
				$iTemp++;
				$sumNumColSpan ++;
			}

				
			$attObj = $this->arrayFormElementType[$nameField];
			if ($numColSpan){
				switch($attObj){
					case 'textarea':
						$buf .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
						         array('width="'.intval($widthCol*$numColSpan).'%"','width="'.intval($widthCol*$numColSpan).'%"','colspan="'.($numColSpan*2).'"','colspan="'.($numColSpan*2).'"','',''),$this->arrayFormElements[$nameField]);
						break;
					default:
						$buf .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
						         array('width="'.intval($widthCol*$numColSpan).'%"','width="'.intval($widthCol*$numColSpan).'%"','colspan="'.$numColSpan.'"','colspan="'.$numColSpan.'"','',''),$this->arrayFormElements[$nameField]);
						break;
				}
			}else{
				switch($attObj){
					case 'textarea':
						$buf .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
						         array('width="'.intval($widthCol).'%"','width="'.intval($widthCol).'%"','colspan="2"','colspan="2"','',''),$this->arrayFormElements[$nameField]);
						break;
					default:
						$buf .=  "\t\t".str_replace($this->arrayAttributesToReplaceInRow,
						         array('width="'.intval($widthCol).'%"','width="'.intval($widthCol).'%"','','','',''),$this->arrayFormElements[$nameField]);
						break;
				}
			}

			
			if (!(($iTemp)%$this->Cols) && $iTemp){
				$buf .= "\t".'</tr>'."\n";
			}


		}


		$tdFaltan = ($cantTr*$this->Cols)-$sumNumColSpan;
		if ($tdFaltan){
			for ($i = 0; $i < $tdFaltan; $i++){
				$buf .= "\t\t".'<td class="'.$this->styleClassTags.'">&nbsp;</td><td class="'.$this->styleClassTags.'">&nbsp;</td>'."\n";
			}
			$buf .= "\t".'</tr>'."\n";
		}

		$buf .= '</table>'."\n";

		$buf .= '<table border="'.$this->tableBorder.'" align="center" width="'.$this->formWidth.'">'."\n";
		$buf .= '<tr>';

		// Para el primer boton
		$countArrayButtonList = count ($this->arrayButtonList);
		$intWidth = 100;
		if ($countArrayButtonList)
			$intWidth = $intWidth / ($countArrayButtonList+1);
			
		$buf .= '<td align="center" style="text-align:center" width="'.$intWidth.'%">';
			
		$buf.='<button '.$this->checkIsHelping($this->idButtonSubmit).' '.$this->checkIfIsDisabled($this->idButtonSubmit).' value="'.trim(strip_tags($this->strSubmit)).'" class="'.$this->styleClassButtons.'" type="submit" name="'.$this->idButtonSubmit.'" id="'.$this->idButtonSubmit.'" ';
		
		$jsFunctionFB = $this->jsFunctionEvent;
		
		if (stripos($jsFunctionFB,':')!==false){
						
			$mixedExtParams = array();
  			$strMixedParams = '';
		  		
  			$intCountPrm = count($mixedExtParams = split(':',$jsFunctionFB));
  			$iExtParams = 0;
		  		
  			foreach ($mixedExtParams as $param){
					
		  			if (!$iExtParams)
						$jsFunctionFB = $param;
		  			
		  			if ($jsFunctionFB!=$param){
		  				if (!is_numeric($param))
							$strMixedParams .= '\''.$param.'\'';
						else	
							$strMixedParams .= $param;
		  			}
		  			
		  			if (($iExtParams+1)<$intCountPrm){
						$strMixedParams .= ',';
		  			}
		  			
				$iExtParams++;					  			
			}
		  		
		}
		
		if ($this->jsFunctionEvent && !$this->Action){
			
			$buf .= ' onclick="'.$this->prefAjax.$jsFunctionFB.'(GetDataForm(\''.$this->NomForm.'\')'.$strMixedParams.')"';
		}else if ($this->jsFunctionEvent && $this->Action){
			
		    $buf .= ' onclick="'.$this->prefAjax.$jsFunctionFB.'(GetDataForm(\''.$this->NomForm.'\')'.$strMixedParams.')"';
		}else{
		    $buf .= ' onclick="'.$this->NomForm.'.submit()" ';
		}

		$buf .= '>';

		if ($this->SrcImageButton)
			$buf .= '<img style="padding-right: 3px; vertical-align: bottom;" src="'.$GLOBALS['urlProject'].$this->subFolder_inImg.$this->SrcImageButton.'" border="0">';
			
		$buf .= $this->strSubmit;

		$buf .= '</button></td>';

		// Para mostrar los demas botones
		for ($j = 0; $j < $countArrayButtonList; $j++){
			$buf .= '<td align="center" style="text-align:center" width="'.$intWidth.'%">';

			$buf .= '<button '.$this->checkIsHelping($this->arrayButtonList[$j]['strName']).' '.$this->checkIfIsDisabled($this->arrayButtonList[$j]['strName']).' value="'.trim(strip_tags($this->arrayButtonList[$j]['strLabel'])).'" class="'.$this->styleClassButtons.'" type="submit" name="'.$this->arrayButtonList[$j]['strName'].'" id="'.$this->arrayButtonList[$j]['strName'].'" ';
			
			if ($this->arrayButtonList[$j]['jsFunction'] && !$this->Action){

				$jsFunction = $this->arrayButtonList[$j]['jsFunction'];
				
				if (stripos($jsFunction,':')!==false){
					
	  				$mixedExtParams = array();
		  			$strMixedParams = '';
		  		
		  			$intCountPrm = count($mixedExtParams = split(':',$jsFunction));
		  			$iExtParams = 0;
		  		
		  			foreach ($mixedExtParams as $param){
					
		  				if (!$iExtParams)
					   		$jsFunction = $param; 	
		  			
		  				if ($jsFunction!=$param){
		  					if (!is_numeric($param))
								$strMixedParams .= '\''.$param.'\'';
							else	
								$strMixedParams .= $param;
		  				}
		  			
		  				if (($iExtParams+1)<$intCountPrm){
							$strMixedParams .= ',';
		  				}
		  			
						$iExtParams++;					  			
		  			}
		  		
		  		}
				
				$buf .= ' onclick="'.$this->prefAjax.$jsFunction.'(GetDataForm(\''.$this->NomForm.'\')'.$strMixedParams.')"';
				
			}else if ($this->arrayButtonList[$j]['jsFunction'] && $this->Action){
				
				$buf .= ' onclick="'.$this->prefAjax.$this->arrayButtonList[$j]['jsFunction'].'(GetDataForm(\''.$this->NomForm.'\')'.$strMixedParams.')"';
			}else{
				$buf .= ' onclick="'.$this->NomForm.'.submit()" ';
			}
			$buf .= '>';

			if ($this->arrayButtonList[$j]['strSrcImg'])
			$buf .= '<img style="padding-right: 3px; vertical-align: bottom;" src="'.$this->arrayButtonList[$j]['strSrcImg'].'" border="0">';

			$buf.=$this->arrayButtonList[$j]['strLabel'];

			$buf.='</button></td>';
		}

		$buf .='</tr>';
		$buf .= '</table>'."\n";

		$buf .= '</form>'."\n";

		if (strlen($this->strNameFieldSet))
			$buf .= '</fieldset>'."\n";
			
		$buf .= '</div>'."\n";

		$buf .= '<!-- Fin de Formulario: '.$this->NomForm.' -->'."\n";

		return $buf;
	}

	/**
	 * Genera una pequena cadena Js que se
	 * usa dentro como parametro unico
	 * en los $objResponse->addScript()
	 * con el objetivo de actualizar mas
	 * rapido un campo sin necesidad escribir codigo
	 * javascript.
	 *
	 * @param string $strElementId Nombre o Id del elemento a refrescar
	 * @param string $strAtribute  Atributo del elemento
	 * @param string $strNewValue  Nuevo valor, en blanco para limpiar
	 * @param string $boolOpener   Si se trata de actualizar una ventana padre o no
	 * @return string
	 */
	public function jsUpdateElement ($strElementId, $strAtribute, $strNewValue = '', $boolOpener = false){
		$js = '';

		if ($boolOpener):$boolOpener = 'opener.';endif;
			$js .= $boolOpener.'document.getElementById("'.$strElementId.'").'.$strAtribute.'=\''.$strNewValue.'\'';

		return $js;
	}


	/**
	 * Genera un pequena cadena Js que se
	 * usa dentro como parametro unico en los
	 * $objResponse->addScript() con el
	 * objetivo de actualizar las rapido
	 * un campo sin necesidad de escribir codigo javascript.
	 *
	 * @param string $strElementId Nombre o Id del elemento a refrescar
	 * @param string $strAtribute  Atributo del elemento
	 * @param string $boolOpener   Nuevo valor, en blanco para limpiar
	 * @return string
	 */
	public function jsClearElement ($strElementId, $strAtribute, $boolOpener = false){
		return $this->jsUpdateElement($strElementId, $strAtribute, '', $boolOpener);
	}


	/**
	 * Genera una pequena cadena con codigo Js
	 * que se puede llamar para sobre un evento
	 * abrir mas rapidamente una ventana.
	 *
	 * @param string  $strUrl    Url del contenido de la ventana que se piensa mostrar
	 * @param integer $intWidth  Ancho de la ventana
	 * @param integer $intHeight Alto de la ventana
	 * @param string  $strName   Nombre de la ventana si se desea abrir una nueva y que esta no sea reemplazada
	 * @return string
	 */
	public function jsOpenWindow ($strUrl, $intWidth = '400', $intHeight = '400', $strName = ''){
		$js = '';
			
		$js .= 'OpenWindowForm (\''.$strName.'\','.$intWidth.','.$intHeight.',\''.$strUrl.'\')';

		return $js;
	}


	/*
	 * Cache de los formularios
	 */


	/**
	 * Verifica si un formulario esta o no cacheado
	 *
	 * @param string $strNomForm
	 * @return boolean
	 */
	public function isCached ($strNomForm){
		$return = false;
			
		if (file_exists($this->cache_dir.$strNomForm.session_id().$this->cache_ext_file));
			$return = true;

		return $return;
	}


	/**
	 * Configura la cache de el formualario para ser usada
	 * e activa por cada $intSeconds
	 *
	 * @param boolean $boolUseCache  Usar la cache o no
	 * @param integer $intSeconds    Numero de segundos en que la cache dura activa
	 */
	public function setCache ($boolUseCache = false, $intSeconds = 3600){
		$this->use_cache = $boolUseCache;
		$this->cache_int_seconds_time = $intSeconds;
	}


	/**
	 *  Actualiza el valor de una constante para que esta sea de nuevo leida por una aplicacion
	 *  En varias apliaciones es necesario leer el valor de una constante para que se pueda
	 *  obtener un parametro de configuracion
	 *  @param string $nam_cons, nombre de la constante que estoy buscando
	 *  @param string $new_val, Nuevo valor asignado para esa constante
	 *  @param string $file, la ruta del archivo de configuracion en donde se encuentra la variable
	 *
	 * Ejemplo
	 * archivo config.php
	 *   define ("SALUDO","Hola mundo");
	 *
	 * archivo modifica.php
	 *   print SALUDO;
	 *   $objMyForm->UpdateDefineValue('SALUDO','Joselitohacker','config.php');
	 *   print SALUDO;
	 *
	 * Salida:
	 *   Hola mundoJoselitohacker
	 */
	function updateDefineValue ($nam_cons,$new_val,$file){
		$filename = $file;
		$array = file ($file);
		for ($i=0;$i<count($array);$i++){
			if (strpos( $array[$i],$nam_cons)){
				$array[$i] = "";
				$array[$i] = "define(\"".$nam_cons."\",\"\");\n";
			}
		}

		$fd = fopen ($filename, "w+");
		for ($i=0;$i<count($array);$i++){
			fputs ($fd,$array[$i]);
		}
			
		fclose ($fd);
		$array = file ($file);

		for ($i=0;$i<count($array);$i++){
			if (strpos( $array[$i],$nam_cons)){
				$array[$i] = "";
				$array[$i] = "define(\"".$nam_cons."\",\"".$new_val."\");\n";
			}
		}
			
		$fd = fopen ($filename, "w+");
		for ($i=0;$i<count($array);$i++){
			fputs ($fd,$array[$i]);
		}

		fclose ($fd);
	}



 function jsRedirect ($strUrlPage,$intSeconds = 2, $strMsg = 'Any message' ){
    	$js  = '<script type="text/javascript">'."\n";
    	$js .= 'function jsRedirect(){'."\n";
    	$js .= 'location.href="'.$strUrlPage.'" }'."\n";
    	$js .= 'setTimeout ("jsRedirect()", '.($intSeconds*1000).');'."\n";
    	$js .= '</script>'."\n";

    	$js .= '<center><br><a href="'.$strUrlPage.'" class="contenido">'.$strMsg.'</a></center>';
    	return $js;
    }


	// Fin de la Clase
}
?>