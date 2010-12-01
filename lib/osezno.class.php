<?php
/**
 * oszeno.class.php
 * @uses Metodos y atributos propios del proyecto
 * @package OSEZNO FRAMEWORK (2008-2011)
 * @version 0.1
 * @author Jose Ignacio Gutierrez Guzman jose.gutierrez@osezno-framework.org
 *
 */	
class osezno {
  	
  	/**
  	 * Ruta fisica donde se encuentra nuestro proyecto
  	 *
  	 * @var string
  	 */
  	private $folderProject = '';
  	
  	/**
  	 * Url base donde esta ubicado el proyecto
  	 *
  	 * @var string
  	 */
  	private $urlProject = '';
  	
  	/**
  	 * Ruta fisica donde se encuentran las plantillas
  	 *
  	 * @var string
  	 */
  	private $pathFolderTemplates;
  	
  	/**
  	 * Arreglo con los areas del head que se van a autocompletar
  	 *
  	 * @var mixed
  	 */
  	private $arrayAssignAreasHead = array ();
  	
  	/**
  	 * Arreglo con los areas del body que se van a autocompletar
  	 *
  	 * @var mixed
  	 */  	
  	private $arrayAssignAreasBody = array ();
  	
  	/**
  	 * Arreglo con los areas del plantilla que se van a completar por los usuarios
  	 *
  	 * @var mixed
  	 */  	
  	private $assignAreas = array ();
  	
  	/**
  	 * Objeto de xajax
  	 *
  	 * @var object
  	 */
  	private $objxAjax;
  	
  	/**
  	 * Contructor de la clase
  	 * Define caracteristicas iniciales del proyecto
  	 * para que este pueda comenzar a ser usado
  	 *
  	 */
  	public function __construct($objxAjax = ''){
  		
  		$this->folderProject = $GLOBALS['folderProject'];
  		
  		$this->urlProject = $GLOBALS['urlProject'];
  		 
		$this->objxAjax = $objxAjax;
  		
  		require $this->folderProject.'lib/plugin/packages/xajax/xajax_plugins/response/modalWindow/myModalWindow.class.php';
  		
		$this->arrayAssignAreasHead['xajax_scripts']
		= $this->objxAjax->getJavascript(URL_JS_XJX);
		
		$this->arrayAssignAreasHead['string_favicon']
		= '<link rel="shortcut icon" href="'.
		URL_FAV_ICON.
		'">';
		
		$this->arrayAssignAreasHead['string_js_common']
		 = '<script type="text/javascript" src="'.
		 URL_JS_FCN.
		 '"></script>';
		
		$this->arrayAssignAreasHead['string_js_mw']
		 = '<script type="text/javascript" src="'.
		 URL_JS_MW.
		 '"></script>';		 
		 
		$this->arrayAssignAreasHead['string_js_swf_hld']
		= '<script type="text/javascript" src="'.
		URL_SWF_HLD.
		'"></script>';
		 
		$this->arrayAssignAreasHead['string_js_swf_fcn']
		= '<script type="text/javascript" src="'.
		URL_SWF_FCN.
		'"></script>';
		 
		$this->arrayAssignAreasHead['string_js_mylist']
		= '<script type="text/javascript" src="'.
		URL_JS_ML.
		'"></script>';
		
		$this->arrayAssignAreasHead['string_js_mytabs']
		= '<script type="text/javascript" src="'.
		URL_JS_MT.
		'"></script>';
		
		$this->arrayAssignAreasHead['string_js_mycalendar']
		= '<script type="text/javascript" src="'.
		URL_JS_MC.
		'"></script>';
		
		$this->arrayAssignAreasBody['string_js_tooltip']
		= '<script type="text/javascript" src="'.
		URL_JS_TT.
		'"></script>';
		
		$this->arrayAssignAreasBody['string_js_balloon']
		= '<script type="text/javascript" src="'.
		URL_JS_TB.
		'"></script>';
		
		$this->arrayAssignAreasBody['string_js_resize']
		= '<script type="text/javascript">window.onresize=Resize;</script>';
		
		/**
		 * Llamar a las diferentes hojas de estilos
		 */
		$this->arrayAssignAreasHead['string_css_calendar']
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/calendar/style.php'.
		'" rel="stylesheet" type="text/css" />';

		$this->arrayAssignAreasHead['string_css_mylist']     
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/mylist/style.php?path_img='.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/mylist/'.
		'" rel="stylesheet" type="text/css" />';
		
		$this->arrayAssignAreasHead['string_css_myform']     
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/myform/style.php?path_img='.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/myform/'.
		'" rel="stylesheet" type="text/css" />';
		
		$this->arrayAssignAreasHead['string_css_message_box']     
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/msg_box/style.php?path_img='.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/msg_box/'.
		'" rel="stylesheet" type="text/css" />';
		
		$this->arrayAssignAreasHead['string_css_modal_window']     
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/modal_window/style.php?path_img='.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/modal_window/'.
		'" rel="stylesheet" type="text/css" />';
		
		$this->arrayAssignAreasHead['string_css_notification_window']     
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/notification_window/style.php?path_img='.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/notification_window/'.
		'" rel="stylesheet" type="text/css" />';

		$this->arrayAssignAreasHead['string_css_tabs']     
		= '<link href="'.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/mytabs/style.php?path_img='.$GLOBALS['urlProject'].'/themes/'.THEME_NAME.'/mytabs/'.
		'" rel="stylesheet" type="text/css" />';
		
		$cssErrors = 
'.error {
	border-radius: 10px 10px 10px 10px;
	-moz-border-radius: 10px 10px 10px 10px;
	background-color:#FDCCCD;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	text-decoration: none;
	text-align:left;
	color: red;
	border-color:#CC0000;
	border-width: 1px;
	border-style: solid;
	padding-left:10px;
	padding-top:10px;	
	padding-bottom:10px;
	padding-right:10px;
}

.error_detail {
	border-radius: 10px 10px 10px 10px;
	-moz-border-radius: 10px 10px 10px 10px;
	background-color:#CCCCCC;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-style: normal;
	text-decoration: none;
	text-align:left;
	color: #333333;
	border-color:#666666;
	border-width: 1px;
	border-style: solid;
	padding-left:10px;
	padding-top:10px;	
	padding-bottom:10px;
	padding-right:10px;
}';
		
		$this->arrayAssignAreasHead['css_errors'] = '<style type="text/css">'."\n".$cssErrors."\n".'</style>';
  	}
  	
  	/**
  	 * Setea el nombre del tema de estilos que se va a usar en todo el framework
  	 * 
  	 * @param $theme	Nombre del tema
  	 */
  	public function setTheme ($theme){
  		$this->theme = $theme;
  	}
  	
	/**
	 * Obtiene la ruta fisica del proyecto
	 *
	 * @return string
	 */
  	public function getPathProject (){
  		return $this->folderProject;
  	}
  	
  	/**
  	 * Obtiene la url base del proyecto
  	 *
  	 * @return string
  	 */
  	public function getUrlProject (){
  		return $this->urlProject;
  	}
  	
  	/**
  	 * Configura la ruta fisica donde se encuentran las plantillas
  	 *
  	 * @param string $newpath
  	 */
  	public function setPathFolderTemplates ($newpath){
  		$this->pathFolderTemplates = $newpath; 
  	}
  	
  	/**
  	 * Asigna un contenido de usuario a una area de la plantilla
  	 *
  	 * @param string $nameRef
  	 * @param string $cont
  	 */
  	public function assign ($nameRef,$cont){
  		$this->arrayAssignAreas['{'.$nameRef.'}'] = $cont;
  	}
  	
  	/**
  	 * Obtiene todas las areas del head a reemplazar
  	 *
  	 * @return string
  	 */
  	private function getAllHead (){
  		$toReturn = '';
  		
  		foreach ($this->arrayAssignAreasHead as $key => $cont){
  			 $toReturn .= $cont."\n";
  		}
  		
  		return $toReturn;
  	}
  	
  	/**
  	 * Obtiene todas la areas del body a reemplazar
  	 *
  	 * @return string
  	 */
  	private function getAllBody (){
  		$toReturn = '';
  		
  		foreach ($this->arrayAssignAreasBody as $key => $cont){
  			 $toReturn .= $cont."\n";
  		}
  		
  		return $toReturn;
  	}
  	
  	/**
  	 * Muestra la plantilla seleccionada
  	 *
  	 * @param string $strNameTemplate
  	 */
  	public function call_template ($strNameTemplate){
  		
  		$newContent = '';
  		
  		/**
  		 * Obtension de la plantilla
  		 */
  		$linkTpl = @fopen($fileName = $this->pathFolderTemplates.$strNameTemplate,'r');
  		
  		if ($linkTpl){

  			$contHTML = fread($linkTpl,filesize($fileName));
  			
  			fclose($linkTpl);
  		
  			/**
  		 	 * Areas del usuario
  		 	 */
  			$arrayKeys = array_keys($this->arrayAssignAreas);
  			
  			$newContent = str_ireplace ( $arrayKeys, $this->arrayAssignAreas, $contHTML);

  			/**
  		 	 * Areas de OseznO
  		 	 */
  			$newContent = str_ireplace('</head>', $this->getAllHead().'</head>', $newContent);
  			
  			$newContent = str_ireplace('</body>', $this->getAllBody().'</body>', $newContent);
  		
  			$newContent = preg_replace('(\\{+[0-9a-zA-Z_]+\\})','',$newContent);
  		}else{
  			
  			$msgError = '<div class="error"><b>'.ERROR_LABEL.':</b>&nbsp;'.MSG_TEMPLATE_NO_FOUND.'&nbsp;&quot;'.$strNameTemplate.'&quot;<br><br><div class="error_detail"><b>'.ERROR_DET_LABEL.':</b> '.MSG_TEMPLATE_NO_FOUND_DET.'&nbsp;&quot;'.$this->pathFolderTemplates.'&quot;</div></div>';
  			die ($this->arrayAssignAreasHead['css_errors'].$msgError);
  		}
  		
  		echo $newContent;
  	}
  	
  }
?>