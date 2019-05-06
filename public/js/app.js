$(document).ready( function() {
    const movableSection = $('.table.movable');
    const pageLink = $('.page-link');
    const pageQuantity = pageLink.length - 2;
    const heightOfFirst = movableSection.height();
    let unique = $('.unique');
    const tableHeader = $('.table > thead > tr');

    let setMovableSection = (page) => {
        if (page === 0) {
            return setMovableSection(pageQuantity);
        }
        if (page > pageQuantity) {
            return setMovableSection(1);
        }
        movableSection.each(function() {
            $(this).css({minHeight: heightOfFirst});
            $(this).addClass('hidden').removeClass('active');
            if(page === $(this).data('id')) {
                $(this).removeClass('hidden').addClass('active');
            }
        });
        $('.page-link.active').removeClass('active');
        $('.page-link').each( function() {
            if ($(this).data('id') && $(this).data('id') === page){
                $(this).addClass('active');
            }
        });
    };

    setMovableSection(1);



    pageLink.click(function(e) {
        e.preventDefault();
        let clickedPage = $(this);
        let currentPage = $('.page-link.active').data('id');
        if (clickedPage.hasClass('prev')) {
            return setMovableSection(currentPage - 1);
        }
        if (clickedPage.hasClass('next')) {
            return setMovableSection(currentPage + 1);
        }
        setMovableSection(clickedPage.data('id'));
    });
    window.sorted = -1;

    const clearSortHeader = () => {
        tableHeader.children().each(index => {
            if (window.sorted !== index) {
                tableHeader.children()[index].classList.remove('asc');
                tableHeader.children()[index].classList.remove('desc');
            }
        });
    };


    tableHeader.children().each(function(index, th) {

        unique = $(this);
        unique.click(() => {
            if (index === tableHeader.children().length-1) {
                return false;
            }
            if (!window.hasOwnProperty('sorted')) {
                window.order = false;
            }
            if (window.order) {
                $(this).removeClass('desc');
                $(this).addClass('asc');
            } else {
                $(this).removeClass('asc');
                $(this).addClass('desc');
            }
            let arrayRows = [];
            let activeTable = $('.table.movable.active > tbody');
            let $currentValuesOFFirstRow = activeTable.children().toArray();
            $currentValuesOFFirstRow.forEach((rowIndex, row) => {
                let children = row.children;
                arrayRows[rowIndex] = row;
            });
            $currentValuesOFFirstRow.sort((a, b) => {
                return (window.sorted === index && window.order) ?
                    a.children[index].innerHTML.localeCompare(b.children[index].innerHTML) :
                    b.children[index].innerHTML.localeCompare(a.children[index].innerHTML);
            });
            activeTable.html('');
            $currentValuesOFFirstRow.forEach(row => {
                activeTable.append(row.outerHTML);
            });
            window.sorted = index;
            window.order = !window.order;
            clearSortHeader();
        });

    });


});