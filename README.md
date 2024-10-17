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
        const dropdownA = await dropdownManager.createDropdownFilter({
            containerId: 'dropdown-a',
            containerSelector: '#htmlssp-dropdowns-container-a',
            fetchDataParams: {
                fetchUrl: 'fetch_items.php',
                method: 'GET'
            },
            language: 'en-US',
            localeFolder: './custom-locale/'
        });

        const dropdownB = await dropdownManager.createDropdownFilter({
            containerId: 'dropdown-b',
            containerSelector: '#htmlssp-dropdowns-container-b',
            fetchDataParams: {
                fetchUrl: 'fetch_items.php',
                method: 'GET'
            },
            language: 'zh-HK',
            localeFolder: './'
        });

        const dropdownC = await dropdownManager.createDropdownFilter({
            containerId: 'dropdown-c',
            containerSelector: '#htmlssp-dropdowns-container-c',
            fetchDataParams: {
                fetchUrl: 'fetch_items.php',
                method: 'GET'
            },
            cssOptions: {
                container: 'width: 550px; font-family: "Roboto", sans-serif;',
                searchInput: 'background-color: #d0d0d0; color: #555;',
                button: 'background-color: #FF5722; color: white;',
                dropdownOptions: 'max-height: 300px; border: 2px solid #FF5722;',
            },
            language: 'zh-CN',
            localeFolder: './'
        });

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

        const dropdownD1 = await dropdownManager.createDropdownFilter({
            containerId: 'dropdown-d1',
            containerSelector: '#htmlssp-dropdowns-container-d',
            fetchDataParams: htmlsspFetchDataBypass
        });


        // Set and Get selected items for dropdown B
        dropdownManager.setSelectedItems('dropdown-b', [1, 115182, 47921, 62617, 65420, 67229, 67917, 95022, 107314, 109040, 1300, 12, 13, 14, 18, 19]);
        console.log("Selected item IDs for dropdown B:", dropdownManager.getSelectedItemsIds('dropdown-b'));

        //disable A dropdown
        dropdownManager.disableDropdown('dropdown-a');


        // Example of changing sorting
        setTimeout(() => {
            dropdownD1.setSorting('name', 'ASC');
        }, 5000);


        const dropdownSingle = await dropdownManager.createDropdownFilter({
            containerId: 'dropdown-e',
            containerSelector: '#htmlssp-dropdowns-container-e',
            singleChoice: true
        });

        // Or toggle single choice mode later
        dropdownManager.setSingleChoice('dropdown-c', true);



    });
    
