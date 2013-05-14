<?php

class MapMarkerSet extends DataObject {

	static $db = array(
		'Title' => 'Varchar(255)',
		'Description' => 'Text'
	);

	static $many_many = array('MapMarkers' => 'MapMarker');


	function getCMSFields() {
    	$fields = new FieldList();

    	$fields->push( new TabSet( "Root", $mainTab = new Tab( "Main" ) ) );
    	$mainTab->setTitle( _t( 'SiteTree.TABMAIN', "Main" ) );


    	$fields->addFieldToTab( 'Root.Main',  new TextField( 'Title', 'Title') );
    	$fields->addFieldToTab( 'Root.Main', new TextAreaField( 'Description', 'Description' )  );

		$gridConfig = GridFieldConfig_RelationEditor::create();
    	// need to add sort order in many to many I think // ->addComponent( new GridFieldSortableRows( 'SortOrder' ) );
    	$gridConfig->getComponentByType( 'GridFieldAddExistingAutocompleter' )->setSearchFields( array( 'Title', 'Description' ) );
    	$gridConfig->getComponentByType( 'GridFieldPaginator' )->setItemsPerPage( 100 );


    	$gridField = new GridField( "Markers", "List of Markers:", $this->MapMarkers(), $gridConfig );
    	$fields->addFieldToTab( "Root.Markers", $gridField );


    	return $fields;

    }

		

}