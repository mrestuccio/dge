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
    
    
    
    class public_ods_insumoPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."ods_insumo"');
            $field = new IntegerField('id_insumo', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('no_insumo');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_tipo_insumo');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('id_tipo_insumo', 'public.ods_tipo_insumo', new IntegerField('id_tipo_insumo', null, null, true), new StringField('no_tipo_insumo', 'id_tipo_insumo_no_tipo_insumo', 'id_tipo_insumo_no_tipo_insumo_public_ods_tipo_insumo'), 'id_tipo_insumo_no_tipo_insumo_public_ods_tipo_insumo');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(150);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            $result->AddGroup($this->RenderText('Maestras'));
            $result->AddGroup($this->RenderText('Relaciones'));
            $result->AddGroup($this->RenderText('Paramétricas'));
            $result->AddGroup($this->RenderText('Transacciones'));
            if (GetCurrentUserGrantForDataSource('public.ods_area')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Area'), 'area.php', $this->RenderText('Area'), $currentPageCaption == $this->RenderText('Area'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_bien')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Bien'), 'bien.php', $this->RenderText('Bien'), $currentPageCaption == $this->RenderText('Bien'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_empresa')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Empresa'), 'empresa.php', $this->RenderText('Empresa'), $currentPageCaption == $this->RenderText('Empresa'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_espacio')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Espacio'), 'espacio.php', $this->RenderText('Espacio'), $currentPageCaption == $this->RenderText('Espacio'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_insumo')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Insumo'), 'insumo.php', $this->RenderText('Insumo'), $currentPageCaption == $this->RenderText('Insumo'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_lectura')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Lectura'), 'lectura.php', $this->RenderText('Lectura'), $currentPageCaption == $this->RenderText('Lectura'), false, $this->RenderText('Transacciones')));
            if (GetCurrentUserGrantForDataSource('public.ods_lugar')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Lugar'), 'lugar.php', $this->RenderText('Lugar'), $currentPageCaption == $this->RenderText('Lugar'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_ocupa')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Ocupa (Area / Espacio)'), 'ocupa.php', $this->RenderText('Ocupa'), $currentPageCaption == $this->RenderText('Ocupa (Area / Espacio)'), false, $this->RenderText('Relaciones')));
            if (GetCurrentUserGrantForDataSource('public.ods_origen_lectura')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Origen Lectura'), 'origen_lectura.php', $this->RenderText('Origen Lectura'), $currentPageCaption == $this->RenderText('Origen Lectura'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_origen')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Origen'), 'origen.php', $this->RenderText('Origen'), $currentPageCaption == $this->RenderText('Origen'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_periodicidad')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Periodicidad'), 'periodicidad.php', $this->RenderText('Periodicidad'), $currentPageCaption == $this->RenderText('Periodicidad'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_persona')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Persona'), 'persona.php', $this->RenderText('Persona'), $currentPageCaption == $this->RenderText('Persona'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_realiza')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Realiza (Persona / Tarea)'), 'realiza.php', $this->RenderText('Realiza'), $currentPageCaption == $this->RenderText('Realiza (Persona / Tarea)'), false, $this->RenderText('Relaciones')));
            if (GetCurrentUserGrantForDataSource('public.ods_requiere')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Requiere (Actividad / Insumo)'), 'requiere.php', $this->RenderText('Requiere'), $currentPageCaption == $this->RenderText('Requiere (Actividad / Insumo)'), false, $this->RenderText('Relaciones')));
            if (GetCurrentUserGrantForDataSource('public.ods_tarea')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tarea'), 'tarea.php', $this->RenderText('Tarea'), $currentPageCaption == $this->RenderText('Tarea'), false, $this->RenderText('Transacciones')));
            if (GetCurrentUserGrantForDataSource('public.ods_tarea_plan')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tarea Planificada'), 'tarea_plan.php', $this->RenderText('Tarea Planificada'), $currentPageCaption == $this->RenderText('Tarea Planificada'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_tipo_bien')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Bien'), 'tipo_bien.php', $this->RenderText('Tipo Bien'), $currentPageCaption == $this->RenderText('Tipo Bien'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_tipo_espacio')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Espacio'), 'tipo_espacio.php', $this->RenderText('Tipo Espacio'), $currentPageCaption == $this->RenderText('Tipo Espacio'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_tipo_insumo')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Insumo'), 'tipo_insumo.php', $this->RenderText('Tipo Insumo'), $currentPageCaption == $this->RenderText('Tipo Insumo'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_tipo_persona')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Persona'), 'tipo_persona.php', $this->RenderText('Tipo Persona'), $currentPageCaption == $this->RenderText('Tipo Persona'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_accion')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Accion (Espacio / Tarea)'), 'accion.php', $this->RenderText('Accion'), $currentPageCaption == $this->RenderText('Accion (Espacio / Tarea)'), false, $this->RenderText('Maestras')));
            if (GetCurrentUserGrantForDataSource('public.ods_metodologia')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Metodologia de Acción'), 'metodologia.php', $this->RenderText('Metodologia'), $currentPageCaption == $this->RenderText('Metodologia de Acción'), false, $this->RenderText('Paramétricas')));
            if (GetCurrentUserGrantForDataSource('public.ods_tipo_accion')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipo Accion'), 'tipo_accion.php', $this->RenderText('Tipo Accion'), $currentPageCaption == $this->RenderText('Tipo Accion'), false, $this->RenderText('Paramétricas')));
            
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
            $grid->SearchControl = new SimpleSearch('public_ods_insumossearch', $this->dataset,
                array('id_insumo', 'no_insumo', 'id_tipo_insumo_no_tipo_insumo'),
                array($this->RenderText('Id Insumo'), $this->RenderText('Nombre Insumo'), $this->RenderText('Id Tipo Insumo')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('public_ods_insumoasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id_insumo', $this->RenderText('Id Insumo')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('no_insumo', $this->RenderText('Nombre Insumo')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."ods_tipo_insumo"');
            $field = new IntegerField('id_tipo_insumo', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_tipo_insumo');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_tipo_insumo', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('id_tipo_insumo', $this->RenderText('Id Tipo Insumo'), $lookupDataset, 'id_tipo_insumo', 'no_tipo_insumo', false, 8));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
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
            // View column for id_insumo field
            //
            $column = new TextViewColumn('id_insumo', 'Id Insumo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText('Identificador único del insumo.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for no_insumo field
            //
            $column = new TextViewColumn('no_insumo', 'Nombre Insumo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('public_ods_insumoGrid_no_insumo_handler_list');
            $column->SetDescription($this->RenderText('Nombre del insumo.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for no_tipo_insumo field
            //
            $column = new TextViewColumn('id_tipo_insumo_no_tipo_insumo', 'Id Tipo Insumo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText('Identificador único del tipo de insumo.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id_insumo field
            //
            $column = new TextViewColumn('id_insumo', 'Id Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for no_insumo field
            //
            $column = new TextViewColumn('no_insumo', 'Nombre Insumo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('public_ods_insumoGrid_no_insumo_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for no_tipo_insumo field
            //
            $column = new TextViewColumn('id_tipo_insumo_no_tipo_insumo', 'Id Tipo Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for no_insumo field
            //
            $editor = new TextEdit('no_insumo_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Insumo', 'no_insumo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_tipo_insumo field
            //
            $editor = new ComboBox('id_tipo_insumo_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."ods_tipo_insumo"');
            $field = new IntegerField('id_tipo_insumo', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_tipo_insumo');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_tipo_insumo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Id Tipo Insumo', 
                'id_tipo_insumo', 
                $editor, 
                $this->dataset, 'id_tipo_insumo', 'no_tipo_insumo', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for no_insumo field
            //
            $editor = new TextEdit('no_insumo_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Nombre Insumo', 'no_insumo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_tipo_insumo field
            //
            $editor = new ComboBox('id_tipo_insumo_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."ods_tipo_insumo"');
            $field = new IntegerField('id_tipo_insumo', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('no_tipo_insumo');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('no_tipo_insumo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Id Tipo Insumo', 
                'id_tipo_insumo', 
                $editor, 
                $this->dataset, 'id_tipo_insumo', 'no_tipo_insumo', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // View column for id_insumo field
            //
            $column = new TextViewColumn('id_insumo', 'Id Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for no_insumo field
            //
            $column = new TextViewColumn('no_insumo', 'No Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for no_tipo_insumo field
            //
            $column = new TextViewColumn('id_tipo_insumo_no_tipo_insumo', 'Id Tipo Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id_insumo field
            //
            $column = new TextViewColumn('id_insumo', 'Id Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for no_insumo field
            //
            $column = new TextViewColumn('no_insumo', 'No Insumo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for no_tipo_insumo field
            //
            $column = new TextViewColumn('id_tipo_insumo_no_tipo_insumo', 'Id Tipo Insumo', $this->dataset);
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
        
        public function GetModalGridDeleteHandler() { return 'public_ods_insumo_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_ods_insumoGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(false);
            $this->SetExportToWordAvailable(false);
            $this->SetExportToXmlAvailable(false);
            $this->SetExportToCsvAvailable(false);
            $this->SetExportToPdfAvailable(false);
            $this->SetPrinterFriendlyAvailable(false);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(false);
            $this->SetFilterRowAvailable(false);
            $this->SetVisualEffectsEnabled(false);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            //
            // View column for no_insumo field
            //
            $column = new TextViewColumn('no_insumo', 'Nombre Insumo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_ods_insumoGrid_no_insumo_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for no_insumo field
            //
            $column = new TextViewColumn('no_insumo', 'Nombre Insumo', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_ods_insumoGrid_no_insumo_handler_view', $column);
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
        $Page = new public_ods_insumoPage("insumo.php", "public_ods_insumo", GetCurrentUserGrantForDataSource("public.ods_insumo"), 'UTF-8');
        $Page->SetShortCaption('Insumo');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Insumo');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("public.ods_insumo"));
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
	
