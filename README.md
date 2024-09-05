# html-mass-selection-server-side-processing
    With AI(Claude-3.5-Sonnet)'s help, no coding required and build the demo for the case when there are mass selection on html rendering and convert to server side processing

# Demo
[![Youtube Video](https://img.youtube.com/vi/qu93nkFbcWY/maxresdefault.jpg)](https://www.youtube.com/watch?v=qu93nkFbcWY)

# Guide
## Html Init
     <div id="htmlssp-dropdowns-container"></div>
## JS Examples
    // Example usage:
    document.addEventListener('DOMContentLoaded', async () => {
        // Create initial dropdown filters
        const dropdownA = createHTMLSSPDropdownFilter('dropdown-a');
        const dropdownB = createHTMLSSPDropdownFilter('dropdown-b');
        const dropdownC = createHTMLSSPDropdownFilter('dropdown-c', {
            container: 'width: 550px; font-family: "Roboto", sans-serif;',
            searchInput: 'background-color: #d0d0d0; color: #555;',
            button: 'background-color: #FF5722; color: white;',
            dropdownOptions: 'max-height: 300px; border: 2px solid #FF5722;',
        });

        // Example with custom fetch parameters
        const dropdownD = createHTMLSSPDropdownFilter('dropdown-d', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'POST',
            initialPage: 2,
            // initialKeyword: 'apple',
            initialStartIndex: 10,
            itemsPerPage: 30,
            sortField: 'name',
            sortOrder: 'DESC',
            additionalParams: {
                // category: 'electronics'
            }
        });

        // Example of changing sorting
        setTimeout(() => {
            dropdownB.setSorting('name', 'ASC');
        }, 5000);

        // Wait for dropdowns to initialize before setting items
        setTimeout(async () => {
            await dropdownB.setSelectedItemsForDropdown([1, 3, 5]);
            console.log("Selected items for dropdown B:", dropdownB.getSelectedItemsForDropdown());
            console.log("Selected item IDs for dropdown B:", dropdownB.getSelectedItemIdsForDropdown());
        }, 1000);
    });
    

    
    
