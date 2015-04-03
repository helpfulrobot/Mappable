<?php

class MapControllerExtension extends Extension {
	private static $allowed_actions = array(
		'markerjson'
	);


	public function markerjson() {
		$model = $this->owner->dataRecord;
		$cachekey = $model->owner->getPoiMarkersCacheKey();
		echo $cachekey;
	}

}
