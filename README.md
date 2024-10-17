# Multiple-Selection-Server-Side-Processing
    With AI(Claude-3.5-Sonnet)'s help, no coding required and build the demo for the case when there are mass selection on html rendering and convert to server side processing

# Demo
[![Youtube Video](https://img.youtube.com/vi/qu93nkFbcWY/maxresdefault.jpg)](https://www.youtube.com/watch?v=qu93nkFbcWY)

# Guide
## Html Init
    <div id="htmlssp-dropdowns-container-a"></div>
    <div id="htmlssp-dropdowns-container-b"></div>
    <div id="htmlssp-dropdowns-container-c"></div>
    <div id="htmlssp-dropdowns-container-d"></div>
## JS Examples
    // Global instance of the dropdown manager
    const dropdownManager = new HTMLSSPDropdownFilterManager();

    document.addEventListener('DOMContentLoaded', async () => {
        // Create initial dropdown filters with different languages
        const dropdownA = await dropdownManager.createDropdownFilter('dropdown-a', '#htmlssp-dropdowns-container-a', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'en-US', './custom-locale/');

        const dropdownB = await dropdownManager.createDropdownFilter('dropdown-b', '#htmlssp-dropdowns-container-b', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'zh-HK');

        const dropdownC = await dropdownManager.createDropdownFilter('dropdown-c', '#htmlssp-dropdowns-container-c', {
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

        const dropdownD1 = await dropdownManager.createDropdownFilter('dropdown-d1', '#htmlssp-dropdowns-container-d', {}, htmlsspFetchDataBypass);

        const dropdownD2 = await dropdownManager.createDropdownFilter('dropdown-d2', '#htmlssp-dropdowns-container-d', {}, {
            fetchUrl: 'fetch_items.php',
            method: 'GET'
        }, 'en-US');

        // Set and Get selected items for dropdown B
        dropdownManager.setSelectedItems('dropdown-b', [21, 31, 51]);
        console.log("Selected item IDs for dropdown B:", dropdownManager.getSelectedItemsIds('dropdown-b')); 

        //disable A dropdown
        dropdownManager.disableDropdown('dropdown-a');


        // Example of changing sorting
        setTimeout(() => {
            dropdownD1.setSorting('name', 'ASC');
        }, 5000);



    });

    
