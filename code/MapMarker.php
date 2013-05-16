<?php
class MapMarker extends DataObject {

     static $belongs_many_many = array(
		'MapMarkerSets' => 'MapMarkerSet'
	);

	static $db = array(
		'Title' => 'Varchar(255)',
		'Description' => 'HTMLText'
	);

	 static $has_one = array(
		'MapMarkerType' => 'MapMarkerType'
	);

	function getCMSFields() {
		$fields = new FieldList();
		$fields->push( new TabSet( "Root", $mainTab = new Tab( "Main" ) ) );
		$mainTab->setTitle( _t( 'SiteTree.TABMAIN', "Main" ) );

		$fields->addFieldToTab( 'Root.Main',  new TextField( 'Title', 'Title') );
		$fields->addFieldToTab( 'Root.Main', new TextAreaField( 'Description', 'Description' )  );
		$markerTypes = MapMarkerType::get()->sort('Title')->map('ID', 'Title');
		$fields->addFieldToTab( 'Root.Main', new DropdownField( 'MapMarkerTypeID', 'Type of map marker', $markerTypes )  );

		$sets = $this->MapMarkerSets();
		$this->updateCMSFields($fields);

		return $fields;
	}


	/*
	Find all the markers in all of the sets that the current marker is in.  These will be rendered in grey as an
	aid to find the location of the current marker
	*/
	public function getMappableGuidePoints() {
		$result = array();

		foreach ($this->MapMarkerSets() as $set) {
			foreach($set->MapMarkers() as $m) {
				if (($m->Lat != 0) || ($m->Lon != 0)) {
					array_push($result,array('latitude' => $m->Lat, 'longitude' => $m->Lon));
				}
			}
		
		}

		return $result;
	}
}