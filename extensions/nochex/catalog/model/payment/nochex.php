<?php

namespace Opencart\Catalog\Model\Extension\Nochex\Payment;
 

class Nochex extends \Opencart\System\Engine\Model {

	public function getMethod($address): array {
		$this->load->language('extension/nochex/payment/nochex');
 

$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('nochex_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		
		/*if ($this->config->get('nochex_total') > $total) {
			$status = false;
		} else*/if (!$this->config->get('nochex_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = [];

		if ($status) {
			$method_data = [
				'code'       => 'nochex',
				'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('nochex_sort_order')
			];
		}
		return $method_data;
	}
}