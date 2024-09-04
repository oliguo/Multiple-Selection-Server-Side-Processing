# html-mass-selection-server-side-processing
    With AI(Claude-3.5-Sonnet)'s help, no coding required and build the demo for the case when there are mass selection on html rendering and convert to server side processing

# Demo
[![Youtube Video](https://img.youtube.com/vi/qu93nkFbcWY/maxresdefault.jpg)](https://www.youtube.com/watch?v=qu93nkFbcWY)

# Guide
## Html Div container
     <div id="htmlssp-dropdowns-container"></div>

## Change the api / data from server side "fetch_items.php"
    // Function to fetch data from the server (replace with your actual data fetching logic)
    async function htmlsspFetchData(page, keyword, startIndex = 0, limit = 20) {
        try {
            const response = await fetch(`fetch_items.php?page=${page}&keyword=${keyword}&startIndex=${startIndex}&limit=${limit}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Error fetching data:", error);
            return { options: [], totalPages: 0, currentPage: 0 };
        }
    }

## Generate the search filter
    // Create initial dropdown filters
    const dropdownA = createHTMLSSPDropdownFilter('dropdown-a');
    
    // Create initial dropdown filters with custom CSS
    const dropdownA = createHTMLSSPDropdownFilter('dropdown-a', {
        container: 'width: 500px; font-family: "Helvetica", sans-serif;',
        searchInput: 'background-color: #f0f0f0; color: #333;',
        button: 'background-color: #4CAF50; color: white;',
        dropdownOptions: 'max-height: 250px; border: 2px solid #4CAF50;',
    });
## Get Items, Items' id
    // Example usage:
    // Get selected items for dropdown A
    // console.log(getSelectedItemsForDropdown('dropdown-a'));

    // Get selected item IDs for dropdown C
    // console.log(getSelectedItemIdsForDropdown('dropdown-c'));

## Preset existing items on the list
    // Set selected items for dropdown B
    // setSelectedItemsForDropdown('dropdown-b', [1, 3, 5]);
    
