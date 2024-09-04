# html-mass-selection-server-side-processing
    With AI(Claude-3.5-Sonnet)'s help, no coding required and build the demo for the case when there are mass selection on html rendering and convert to server side processing

# Demo
[![Youtube Video](https://img.youtube.com/vi/qu93nkFbcWY/maxresdefault.jpg)](https://www.youtube.com/watch?v=qu93nkFbcWY)

# Guide
## Html Div container
     <div id="htmlssp-dropdowns-container"></div>

## Change the api / data from server side "fetch_items.php"
    //you can follow the paramter to pass
    // Function to fetch data from the server (replace with your actual data fetching logic)
    // async htmlsspFetchData(page, keyword, startIndex = 0, limit = 20) {...}
    const htmlsspFetchDataBypass = ['fetch_items.php'];
    const dropdownD = createHTMLSSPDropdownFilter('dropdown-d', {}, htmlsspFetchDataBypass);
## Init
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
    const htmlsspFetchDataBypass = ['fetch_items.php'];
    const dropdownD = createHTMLSSPDropdownFilter('dropdown-d', {}, htmlsspFetchDataBypass);

    // Wait for dropdowns to initialize before setting items
    setTimeout(async () => {
        await dropdownB.setSelectedItemsForDropdown([1, 3, 5]);
        console.log("Selected items for dropdown B:", dropdownB.getSelectedItemsForDropdown());
        console.log("Selected item IDs for dropdown B:", dropdownB.getSelectedItemIdsForDropdown());
    }, 1000);
    
