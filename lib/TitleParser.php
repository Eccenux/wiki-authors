<?php
/**
 * Title parser.
 * 
 * Namespace:Title to [id, title]
 */
class TitleParser
{
	private $namespaceMap = [];

	/*!
		@brief Constructor that prepares some cache.
	*/
	public function __construct()
	{
		$namespaceArray = include './lang/namespace.php';

		// Convert the namespace array into a quick lookup associative map for both English and Polish names
		$this->namespaceMap = $this->buildNamespaceMap($namespaceArray);
	}

	/*!
		@brief Parse the full page name (namespace:title) into namespace number and page title.
		
		@param [in] $fullPageName The full name of the article, including namespace (e.g., "Szablon:Nux").
		@return An associative array with 'namespace' and 'title' or false on failure.
	*/
	public function parseNamespaceAndTitle($fullPageName)
	{
		// Split the article full name into namespace and title
		$parts = explode(':', $fullPageName, 2);
		if (count($parts) < 2) {
			// No namespace part found
			return $fullPageName;
		}

		$namespaceName = $parts[0]; // Namespace part
		$pageTitle = str_replace(' ', '_', $parts[1]); // Title part with spaces replaced by underscores

		// Lookup the namespace ID from the associative map
		if (array_key_exists($namespaceName, $this->namespaceMap)) {
			return [
				'namespace' => $this->namespaceMap[$namespaceName],
				'title' => $pageTitle
			];
		}

		// Namespace not found
		return $fullPageName;
	}

	/*!
		@brief Build an associative map of namespaces for quick lookup.
		
		@param [in] $namespaceArray The array loaded from the config file.
		@return An associative array for namespace lookup.
	*/
	private function buildNamespaceMap($namespaceArray)
	{
		$map = [];

		// Loop through the array and map both 'canon' (English) and 'pl' (Polish) to the 'id'
		foreach ($namespaceArray as $namespace) {
			$map[$namespace['canon']] = $namespace['id'];
			$map[$namespace['pl']] = $namespace['id'];
		}

		return $map;
	}
}
