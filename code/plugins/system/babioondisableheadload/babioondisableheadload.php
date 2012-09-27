<?php
/**
 * BABIOON System Plugin
 * @author Robert Deutz (email contact@rdbs.net / site www.rdbs.de)
 * @version 0.9
 * @package BABIOON_DISABLEHEADLOAD
 *
 * This is free software
 *
 **/

/**
 * RDBS System Plugin
 *
 * @author		Robert Deutz
 * @package		BABIOON_DISABLEHEADLOAD
 */
class plgSystemBabioonDisableHeadLoad extends JPlugin
{
	
	/**
	 * runs before the framework creates the head section of the document.
	 * 
	 */
	public function onBeforeCompileHead()
	{
		if ( $this->params->get('disablejs') || $this->params->get('disablecss') )
		{
			$app = JFactory::getApplication();
			if ($app->isSite())
			{
				$doc=JFactory::getDocument();
				$headdata = $doc->getHeadData();
				if ( $this->params->get('disablejs') )
				{
					$fnjs=$this->params->get('fnjs');
					if (trim($fnjs) != '')
					{
						$filesjs=explode(',', $fnjs);
						$head = (array) $headdata['scripts'];
						$newhead = array();					
						foreach($head as $key => $elm)
						{
							$add = true;
							foreach ($filesjs as $dis)
							{
								if (strpos($key,$dis) !== false)
								{
									$add=false;
									break;
								}	
							}
							if ($add) $newhead[$key] = $elm;
						}
						$headdata['scripts'] = $newhead;
					}	
				} 

				if ( $this->params->get('disablecss') )
				{
					$fncss=$this->params->get('fncss');
					if (trim($fncss) != '')
					{
						$filescss=explode(',', $fncss);
						$head = (array) $headdata['styleSheets'];
						$newhead = array();					
						foreach($head as $key => $elm)
						{
							$add = true;
							foreach ($filescss as $dis)
							{
								if (strpos($key,$dis) !== false)
								{
									$add=false;
									break;
								}	
							}
							if ($add) $newhead[$key] = $elm;
						}
						$headdata['styleSheets'] = $newhead;
					}	
				}
				$doc->setHeadData($headdata); 
			}
		}
	}
}