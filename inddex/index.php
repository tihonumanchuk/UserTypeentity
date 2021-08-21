private function userTypeEntity()
	{
		//проверяем на наличие пользовательского поля , если нет то добавляем
		$fieldNames = array("UF_ORIGINAL_ID", "UF_ORIGINAL_SEC_ID");
		$rsData = CUserTypeEntity::GetList( array($by=>$order), array(
			"ENTITY_ID" 	=> "IBLOCK_".$this->iblockId."_SECTION",
			"FIELD_NAME"	=> array("UF_ORIGINAL_ID", "UF_ORIGINAL_SEC_ID")
			));
		while($arRes = $rsData->Fetch())
		{
			$arResult[] = $arRes["FIELD_NAME"];
		}

		foreach ($fieldNames as $key => $value) {
			if(in_array($value, $arResult) == false){

				$oUserTypeEntity    = new CUserTypeEntity();
		 		$aUserFields    = array(
				    'ENTITY_ID'         => 'IBLOCK_'.$this->iblockId.'_SECTION',
				/* Код поля. Всегда должно начинаться с UF_ */
				    'FIELD_NAME'        => $value,
				    'USER_TYPE_ID'      => 'integer',
					'XML_ID'            => '',
					'SORT'              => 500,
					'MULTIPLE'          => 'N',
				    'MANDATORY'         => 'N',
				    'SHOW_FILTER'       => 'N',
				    'SHOW_IN_LIST'      => '',
				    'EDIT_IN_LIST'      => '',
				    'IS_SEARCHABLE'     => 'N',
				    'SETTINGS'          => array(
				        'DEFAULT_VALUE' => '',
				        'SIZE'          => '20',
				        'MIN_LENGTH'    => '0',
				        'MAX_LENGTH'    => '0',
				        'REGEXP'        => '',
					),
				    'EDIT_FORM_LABEL'   => array(
				        'ru'    => $value,
				        'en'    => 'User field',
				    ),
				    'LIST_COLUMN_LABEL' => array(
				        'ru'    => $value,
				        'en'    => 'User field',
				    ),
				    'LIST_FILTER_LABEL' => array(
				        'ru'    => $value,
					'en'    => 'User field',
					),
				    'ERROR_MESSAGE'     => array(
				        'ru'    => 'Ошибка при заполнении пользовательского свойства',
				        'en'    => 'An error in completing the user field',
					),
				    'HELP_MESSAGE'      => array(
				    'ru'    => '',
					'en'    => '',
				    ),
				);
				 
				$iUserFieldId   = $oUserTypeEntity->Add( $aUserFields ); // int
				if (isset($iUserFieldId))
				echo 'Добавлено пользовательское поле <br>';
			}
		}
	}
