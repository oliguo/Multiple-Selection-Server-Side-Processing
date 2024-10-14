# Multiple-Selection-Server-Side-Processing
    With AI(Claude-3.5-Sonnet)'s help, no coding required and build the demo for the case when there are mass selection on html rendering and convert to server side processing

# Demo
[![Youtube Video](https://img.youtube.com/vi/qu93nkFbcWY/maxresdefault.jpg)](https://www.youtube.com/watch?v=qu93nkFbcWY)

# Guide
## Html Init
     <div id="htmlssp-dropdowns-container"></div>
## JS Examples
     // Global instance of the dropdown manager
    const dropdownManager = new HTMLSSPDropdownFilterManager();

    document.addEventListener('DOMContentLoaded', async () => {
        // Create initial dropdown filters with different languages
        const dropdownA = await dropdownManager.createDropdownFilter('dropdown-a', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'en-US');

        const dropdownB = await dropdownManager.createDropdownFilter('dropdown-b', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'zh-HK');

        const dropdownC = await dropdownManager.createDropdownFilter('dropdown-c', {
            container: 'width: 550px; font-family: "Roboto", sans-serif;',
            searchInput: 'background-color: #d0d0d0; color: #555;',
            button: 'background-color: #FF5722; color: white;',
            dropdownOptions: 'max-height: 300px; border: 2px solid #FF5722;',
        }, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'zh-CN');

        // Example with custom fetch parameters
        const htmlsspFetchDataBypass = {
            fetchUrl: 'fetch_items.php',
            method: 'POST',
            initialPage: 2,
            initialKeyword: 'apple',
            initialStartIndex: 10,
            itemsPerPage: 30,
            sortField: 'name',
            sortOrder: 'DESC',
            additionalParams: {
                // category: 'electronics',
            }
        };

        const dropdownD = await dropdownManager.createDropdownFilter('dropdown-d', {}, htmlsspFetchDataBypass);

        // Set selected items for dropdown B
        await dropdownB.setSelectedItemsForDropdown([21, 31, 51]);
        console.log("Selected items for dropdown B:", dropdownB.getSelectedItemsForDropdown());
        console.log("Selected item IDs for dropdown B:", dropdownB.getSelectedItemIdsForDropdown());

        // Example of changing sorting
        setTimeout(() => {
            dropdownD.setSorting('name', 'ASC');
        }, 5000);

        const dropdownE = await dropdownManager.createDropdownFilter('dropdown-e', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'en-US');
        //disable B dropdown
        dropdownManager.disableDropdown('dropdown-b');

    });
    

    
    
