<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/pgsql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    // OnGlobalBeforePageExecute event handler
    
    
    // OnBeforePageExecute event handler
    
    
    
    class public_sga_espacioPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_espacio"');
            $field = new IntegerField('id_espacio', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('id_tipo_espacio');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_espacio_contenedor');
            $this->dataset->AddField($field, false);
            $field = new StringField('co_espacio');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('no_espacio');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('co_plano');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_planta');
            $this->dataset->AddField($field, false);
            $field = new StringField('ds_referencia');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_sector');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('id_tipo_espacio', 'public.sga_tipo_espacio', new IntegerField('id_tipo_espacio', null, null, true), new StringField('ds_referencia', 'id_tipo_espacio_ds_referencia', 'id_tipo_espacio_ds_referencia_public_sga_tipo_espacio'), 'id_tipo_espacio_ds_referencia_public_sga_tipo_espacio');
            $this->dataset->AddLookupField('id_sector', 'public.sga_sector', new IntegerField('id_sector', null, null, true), new StringField('no_sector', 'id_sector_no_sector', 'id_sector_no_sector_public_sga_sector'), 'id_sector_no_sector_public_sga_sector');
            $this->dataset->AddLookupField('id_planta', 'public.sga_planta', new IntegerField('id_planta', null, null, true), new StringField('no_planta', 'id_planta_no_planta', 'id_planta_no_planta_public_sga_planta'), 'id_planta_no_planta_public_sga_planta');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            return null;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            $result->AddGroup($this->RenderText('Maestras'));
            $result->AddGroup($this->RenderText('Param�tricas'));
            if (GetCurrentUserGrantForDataSource('public.sga_accion')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Acci�n (Espacio / Bien)'), 'accion.php', $this->RenderText('Acci�n'), $currentPageCaption == $this->RenderText('Acci�n (Espacio / Bien)'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.sga_tarea_plan')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tarea Planificada'), 'tarea_plan.php', $this->RenderText('Tarea Planificada'), $currentPageCaption == $this->RenderText('Tarea Planificada'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.sga_espacio')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Espacio'), 'espacio.php', $this->RenderText('Espacio'), $currentPageCaption == $this->RenderText('Espacio'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.sga_metodologia')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Metodologia de Acci�n'), 'metodologia.php', $this->RenderText('Metodologia'), $currentPageCaption == $this->RenderText('Metodologia de Acci�n'), false, $this->RenderText('Param�tricas')));
            if (GetCurrentUserGrantForDataSource('public.sga_tipo_accion')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Accion'), 'tipo_accion.php', $this->RenderText('Tipo Accion'), $currentPageCaption == $this->RenderText('Tipo Accion'), false, $this->RenderText('Param�tricas')));
            if (GetCurrentUserGrantForDataSource('public.sga_periodicidad')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Periodicidad'), 'periodicidad.php', $this->RenderText('Periodicidad'), $currentPageCaption == $this->RenderText('Periodicidad'), false, $this->RenderText('Param�tricas')));
            if (GetCurrentUserGrantForDataSource('public.sga_planta')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Planta'), 'planta.php', $this->RenderText('Planta'), $currentPageCaption == $this->RenderText('Planta'), false, $this->RenderText('Param�tricas')));
            if (GetCurrentUserGrantForDataSource('public.sga_sector')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Sector'), 'sector.php', $this->RenderText('Sector'), $currentPageCaption == $this->RenderText('Sector'), false, $this->RenderText('Param�tricas')));
            if (GetCurrentUserGrantForDataSource('public.sga_origen')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Origen'), 'origen.php', $this->RenderText('Origen'), $currentPageCaption == $this->RenderText('Origen'), false, $this->RenderText('Param�tricas')));
            if (GetCurrentUserGrantForDataSource('public.sga_tipo_espacio')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Espacio'), 'tipo_espacio.php', $this->RenderText('Tipo Espacio'), $currentPageCaption == $this->RenderText('Tipo Espacio'), false, $this->RenderText('Param�tricas')));
            
            if ( HasAdminPage() && GetApplication()->HasAdminGrantForCurrentUser() ) {
              $result->AddGroup('Admin area');
              $result->AddPage(new PageLink($this->GetLocalizerCaptions()->GetMessageString('AdminPage'), 'phpgen_admin.php', $this->GetLocalizerCaptions()->GetMessageString('AdminPage'), false, false, 'Admin area'));
            }
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('public_sga_espaciossearch', $this->dataset,
                array('id_espacio', 'id_tipo_espacio_ds_referencia', 'id_sector_no_sector', 'co_espacio', 'no_espacio', 'co_plano', 'id_planta_no_planta', 'ds_referencia'),
                array($this->RenderText('Id Espacio'), $this->RenderText('Tipo Espacio'), $this->RenderText('Sector'), $this->RenderText('C�digo Espacio'), $this->RenderText('Nombre Espacio'), $this->RenderText('C�digo Plano'), $this->RenderText('Planta'), $this->RenderText('Descripci�n')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('public_sga_espacioasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id_espacio', $this->RenderText('Id Espacio')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_tipo_espacio"');
            $field = new IntegerField('id_tipo_espacio', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_tipo_espacio');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_tipo_espacio_padre');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ds_referencia');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('ds_referencia', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('id_tipo_espacio', $this->RenderText('Tipo Espacio'), $lookupDataset, 'id_tipo_espacio', 'ds_referencia', false, 8));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_sector"');
            $field = new IntegerField('id_sector', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_sector');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_sector', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('id_sector', $this->RenderText('Sector'), $lookupDataset, 'id_sector', 'no_sector', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('co_espacio', $this->RenderText('C�digo Espacio')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('no_espacio', $this->RenderText('Nombre Espacio')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('co_plano', $this->RenderText('C�digo Plano')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_planta"');
            $field = new IntegerField('id_planta', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_planta');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_planta', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('id_planta', $this->RenderText('Planta'), $lookupDataset, 'id_planta', 'no_planta', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ds_referencia', $this->RenderText('Descripci�n')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new ModalDialogViewRowColumn(
                    $this->GetLocalizerCaptions()->GetMessageString('View'), $this->dataset,
                    $this->GetLocalizerCaptions()->GetMessageString('View'),
                    $this->GetModalGridViewHandler());
                $grid->AddViewColumn($column, $actionsBandName);
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for id_espacio field
            //
            $column = new TextViewColumn('id_espacio', 'Id Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText('Identificador �nico del espacio.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('id_tipo_espacio_ds_referencia', 'Tipo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'tipo_espacio.php?operation=view&pk0=%id_tipo_espacio%' , '_self');
            $column->SetDescription($this->RenderText('Tipo del espacio.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for no_sector field
            //
            $column = new TextViewColumn('id_sector_no_sector', 'Sector', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'sector.php?operation=view&pk0=%id_sector%' , '_self');
            $column->SetDescription($this->RenderText('Sector en el que se encuentra el espacio.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for co_espacio field
            //
            $column = new TextViewColumn('co_espacio', 'C�digo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText('C�digo de espacio.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for no_espacio field
            //
            $column = new TextViewColumn('no_espacio', 'Nombre Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('public_sga_espacioGrid_no_espacio_handler_list');
            $column->SetDescription($this->RenderText('Nombre del espacio.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for co_plano field
            //
            $column = new TextViewColumn('co_plano', 'C�digo Plano', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText('Codificaci�n del espacio en los planos de Espacio F�sico.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for no_planta field
            //
            $column = new TextViewColumn('id_planta_no_planta', 'Planta', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'planta.php?operation=view&pk0=%id_planta%' , '_self');
            $column->SetDescription($this->RenderText('Planta en la que se encuentra el espacio.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('ds_referencia', 'Descripci�n', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('public_sga_espacioGrid_ds_referencia_handler_list');
            $column->SetDescription($this->RenderText('Referencia del registro.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id_espacio field
            //
            $column = new TextViewColumn('id_espacio', 'Id Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('id_tipo_espacio_ds_referencia', 'Tipo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'tipo_espacio.php?operation=view&pk0=%id_tipo_espacio%' , '_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for no_sector field
            //
            $column = new TextViewColumn('id_sector_no_sector', 'Sector', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'sector.php?operation=view&pk0=%id_sector%' , '_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for co_espacio field
            //
            $column = new TextViewColumn('co_espacio', 'C�digo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for no_espacio field
            //
            $column = new TextViewColumn('no_espacio', 'Nombre Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('public_sga_espacioGrid_no_espacio_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for co_plano field
            //
            $column = new TextViewColumn('co_plano', 'C�digo Plano', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for no_planta field
            //
            $column = new TextViewColumn('id_planta_no_planta', 'Planta', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'planta.php?operation=view&pk0=%id_planta%' , '_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('ds_referencia', 'Descripci�n', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('public_sga_espacioGrid_ds_referencia_handler_view');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for id_espacio field
            //
            $editor = new TextEdit('id_espacio_edit');
            $editColumn = new CustomEditColumn('Id Espacio', 'id_espacio', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_tipo_espacio field
            //
            $editor = new ComboBox('id_tipo_espacio_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_tipo_espacio"');
            $field = new IntegerField('id_tipo_espacio', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_tipo_espacio');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_tipo_espacio_padre');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ds_referencia');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('ds_referencia', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Espacio', 
                'id_tipo_espacio', 
                $editor, 
                $this->dataset, 'id_tipo_espacio', 'ds_referencia', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_sector field
            //
            $editor = new ComboBox('id_sector_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_sector"');
            $field = new IntegerField('id_sector', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_sector');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_sector', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Sector', 
                'id_sector', 
                $editor, 
                $this->dataset, 'id_sector', 'no_sector', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for co_espacio field
            //
            $editor = new TextEdit('co_espacio_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('C�digo Espacio', 'co_espacio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for no_espacio field
            //
            $editor = new TextEdit('no_espacio_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Espacio', 'no_espacio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for co_plano field
            //
            $editor = new TextEdit('co_plano_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('C�digo Plano', 'co_plano', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_planta field
            //
            $editor = new ComboBox('id_planta_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_planta"');
            $field = new IntegerField('id_planta', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_planta');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_planta', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Planta', 
                'id_planta', 
                $editor, 
                $this->dataset, 'id_planta', 'no_planta', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for id_tipo_espacio field
            //
            $editor = new ComboBox('id_tipo_espacio_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_tipo_espacio"');
            $field = new IntegerField('id_tipo_espacio', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_tipo_espacio');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_tipo_espacio_padre');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ds_referencia');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('ds_referencia', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Espacio', 
                'id_tipo_espacio', 
                $editor, 
                $this->dataset, 'id_tipo_espacio', 'ds_referencia', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_sector field
            //
            $editor = new ComboBox('id_sector_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_sector"');
            $field = new IntegerField('id_sector', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_sector');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_sector', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Sector', 
                'id_sector', 
                $editor, 
                $this->dataset, 'id_sector', 'no_sector', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for co_espacio field
            //
            $editor = new TextEdit('co_espacio_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('C�digo Espacio', 'co_espacio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for no_espacio field
            //
            $editor = new TextEdit('no_espacio_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Espacio', 'no_espacio', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for co_plano field
            //
            $editor = new TextEdit('co_plano_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('C�digo Plano', 'co_plano', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_planta field
            //
            $editor = new ComboBox('id_planta_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."sga_planta"');
            $field = new IntegerField('id_planta', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_planta');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_planta', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Planta', 
                'id_planta', 
                $editor, 
                $this->dataset, 'id_planta', 'no_planta', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id_espacio field
            //
            $column = new TextViewColumn('id_espacio', 'Id Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('id_tipo_espacio_ds_referencia', 'Tipo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'tipo_espacio.php?operation=view&pk0=%id_tipo_espacio%' , '_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for no_sector field
            //
            $column = new TextViewColumn('id_sector_no_sector', 'Sector', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'sector.php?operation=view&pk0=%id_sector%' , '_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for co_espacio field
            //
            $column = new TextViewColumn('co_espacio', 'C�digo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for no_espacio field
            //
            $column = new TextViewColumn('no_espacio', 'No Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for co_plano field
            //
            $column = new TextViewColumn('co_plano', 'C�digo Plano', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for no_planta field
            //
            $column = new TextViewColumn('id_planta_no_planta', 'Planta', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'planta.php?operation=view&pk0=%id_planta%' , '_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('ds_referencia', 'Ds Referencia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id_espacio field
            //
            $column = new TextViewColumn('id_espacio', 'Id Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('id_tipo_espacio_ds_referencia', 'Tipo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'tipo_espacio.php?operation=view&pk0=%id_tipo_espacio%' , '_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for no_sector field
            //
            $column = new TextViewColumn('id_sector_no_sector', 'Sector', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'sector.php?operation=view&pk0=%id_sector%' , '_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for co_espacio field
            //
            $column = new TextViewColumn('co_espacio', 'C�digo Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for no_espacio field
            //
            $column = new TextViewColumn('no_espacio', 'No Espacio', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for co_plano field
            //
            $column = new TextViewColumn('co_plano', 'C�digo Plano', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for no_planta field
            //
            $column = new TextViewColumn('id_planta_no_planta', 'Planta', $this->dataset);
            $column->SetOrderable(true);
            $column = new ExtendedHyperLinkColumnDecorator($column, $this->dataset, 'planta.php?operation=view&pk0=%id_planta%' , '_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('ds_referencia', 'Ds Referencia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function GetModalGridViewHandler() { return 'public_sga_espacio_inline_record_view'; }
        protected function GetEnableModalSingleRecordView() { return true; }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'public_sga_espacio_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_sga_espacioGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(true);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
    
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddOperationsColumns($result);
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            //
            // View column for no_espacio field
            //
            $column = new TextViewColumn('no_espacio', 'Nombre Espacio', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_sga_espacioGrid_no_espacio_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('ds_referencia', 'Descripci�n', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_sga_espacioGrid_ds_referencia_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for no_espacio field
            //
            $column = new TextViewColumn('no_espacio', 'Nombre Espacio', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_sga_espacioGrid_no_espacio_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for ds_referencia field
            //
            $column = new TextViewColumn('ds_referencia', 'Descripci�n', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_sga_espacioGrid_ds_referencia_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new public_sga_espacioPage("espacio.php", "public_sga_espacio", GetCurrentUserGrantForDataSource("public.sga_espacio"), 'UTF-8');
        $Page->SetShortCaption('Espacio');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Espacio');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("public.sga_espacio"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }
	
