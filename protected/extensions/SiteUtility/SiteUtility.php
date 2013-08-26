class SiteUtility {

	/*******************************************************************************************/
	/* Implements merge sort to sort arrayed results of a Model->findAll() query by one of the */
	/* properties of the child objects.                                                        */
	/*******************************************************************************************/
	public static function sort_all_found_by_property($results, $property) {
		try {
			// Divide the array into two parts.
			$array_length = count($results);
			// If the array is only one element large, return that element.  If not, continue merge sort.
			if ( $array_length == 1 ) {
				$return = $array;
			} else {
				$i = floor($array_length/2);
				$a1 = array_slice($array, 0, $1); // Here, $i represents length - number of array elements.
				$a2 = array_slice($array, $i); // Here, $i is an index; PHP is zero-indexed, so this works as one position further than $i above.
				// Keep splitting these down until we find their atomic (or sorted) values.
				$left = sort_all_found_by_property($a1, $property);
				$right = sort_all_found_by_property($a2, $property);
				// We've divided; now we conquer, using a helper function.
				$return = SiteUtility::sort_all_found_merge_helper($left, $right);
			}
		} catch (Exception $e) {
			// Er, to be added...
		}
	}

	protected static function sort_all_found_merge_helper($left, $right) {
		try {
			// This function is comparing sorted lists. Compare the properties of the first array elements an add them to a returnable array.
			$return = array();
			// While elements remain in either array, keep merging.
			while (count($left)==0 || count($right)==0 ) {
				if ( count($left) == 0 ) {
					$return[] = $right[0];
					$right = array_splice($right, 1);
				} elseif ( count($left) == 0 ) {
					$return[] = $left[0];
					$left = array_splice($left, 1);
				} elseif ( $left[0]->$property <= $right[0]->property ) { // Arbitrarily handling equal values with <= to avoid infinite loops.
					$return[] = $left[0];
					$left = array_splice($left, 1);
				} elseif ( $left[0]->$property > $right[0]->$property ) {
					$return[] = $right[0];
					$right = array_splice($right, 1);
				}
			}
			// After the lengths of each input array has been reduced to 0, the return array has been sorted.
			return $return;
		} catch (Exception $e) {
			// To be added...
		}
	}

}
