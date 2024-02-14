// app.js
document.addEventListener('DOMContentLoaded', function () {
    
    // Find the parent element where you want to add the new label
    var sizeLabelParent = document.querySelector('.label label[for="size"]');

    // Create a new label element for the size guide
    var sizeGuideLabel = document.createElement('label');

    // Set the attributes for the new label
    sizeGuideLabel.setAttribute('for', 'size_guide'); 
    sizeGuideLabel.textContent = 'Size Guide';
    // Apply styles to the new label
    sizeGuideLabel.style.textDecoration = 'underline';
    sizeGuideLabel.style.cursor = 'pointer';

    // Insert the new label after the size label
    sizeLabelParent.parentNode.insertBefore(sizeGuideLabel, sizeLabelParent.nextSibling);


    // Get Variation Pricing Data
     var variations_form = document.querySelector( 'form.variations_form' );
     var data = variations_form.getAttribute( 'data-product_variations' );
     data = JSON.parse( data );

     // Loop Drop Downs
     document.querySelectorAll( 'table.variations select' )
         .forEach( function( select ) {

         // Loop Drop Down Options
         select.querySelectorAll( 'option' )
             .forEach( function( option ) {
             // Skip Empty
             if( ! option.value ) {
                 return;
             }
             // Generate unique class name based on option value
            var className = option.value.toLowerCase().replace(/\W+/g, '');
            var labelClassName = option.value.toLowerCase().replace(/\W+/g, '');
           
            // Get Pricing For This Option
             var pricing = '';
             data.forEach( function( row ) {
                 if( row.attributes[select.name] == option.value ) {
                     pricing = row.price_html;
                 }
             } );

             // Create label text based on option value
    var labelText = '';
    switch (option.value) {
        case 'Medium':
            labelText = '134mm ';
            break;
        case 'Large':
            labelText = '160mm';
            break;
        case 'Extra Large':
            labelText = '185mm';
            break;
        default:
            labelText = '';
    }
    // Skapa ett span-element för att omsluta textnoden
    var labelTextSpan = document.createElement('span');

    // Skapa textnoden
    var labelTextNode = document.createTextNode(' ' + labelText );
    labelTextSpan.appendChild(labelTextNode);
    // Styla span-elementet
    labelTextSpan.style.color = 'black';
    labelTextSpan.style.fontSize = '18px';
    labelTextSpan.style.fontWeight = 'bold';
    labelTextSpan.style.marginRight = '10px';
    // Create Radio
    var radio = document.createElement( 'input' );
    radio.type = 'radio';
    radio.name = select.name;
    radio.value = option.value;
    radio.checked = option.selected;
    radio.className = className;
            
    var label = document.createElement( 'label' );
    label.className = labelClassName;
    // Lägg till span-elementet i labeln
    label.appendChild(labelTextSpan);
    label.appendChild( radio );
    label.appendChild( document.createTextNode( ' ' + option.text + ' ' ) );    

    var span = document.createElement( 'span' );
    span.innerHTML = pricing;
    label.appendChild( span );
    var div = document.createElement( 'div' );
    div.className = "radioButton";
               
    div.appendChild( label );

     // Insert Radio
    select.closest( 'td' ).className = "variationButtons";
    select.closest( 'td' ).appendChild( div );

// Handle Clicking for Size
if (select.name == 'attribute_size') {
    radio.addEventListener('click', function(event) {
        var sizeLabel = document.querySelector('.label label[for="size"]');
        if (sizeLabel) {
            // Skapa ett span-element för att styla texten separat
            var labelTextSpan = document.createElement('span');
            labelTextSpan.innerText = 'Selected Size ';
            labelTextSpan.style.color = 'gray';
            labelTextSpan.style.fontWeight = '300';

            // Ta bort allt befintligt innehåll i labeln
            sizeLabel.innerHTML = '';

            // Lägg till det stylade textspannet och option.text i labeln
            sizeLabel.appendChild(labelTextSpan);
            sizeLabel.appendChild(document.createTextNode(' ' + option.text));
        }
        event.preventDefault();
        select.value = radio.value;
        jQuery(select).trigger('change');
    });
}

// Handle Clicking for Color
if (select.name == 'attribute_color') {
    radio.addEventListener('click', function(event) {
        var colorLabel = document.querySelector('.label label[for="color"]');
        if (colorLabel) {
            // Skapa ett span-element för att styla texten separat
            var labelTextSpan = document.createElement('span');
            labelTextSpan.innerText = 'Selected Color ';
            labelTextSpan.style.color = 'gray';
            labelTextSpan.style.fontWeight = '300';

            // Ta bort allt befintligt innehåll i labeln
            colorLabel.innerHTML = '';

            // Lägg till det stylade textspannet och option.text i labeln
            colorLabel.appendChild(labelTextSpan);
            colorLabel.appendChild(document.createTextNode(' ' + option.text));
        }
        event.preventDefault();
        select.value = radio.value;
        jQuery(select).trigger('change');
    });
}
         } ); 

         // Hide Drop Down
         select.style.display = 'none';

     } ); // End Drop Downs Loop

 } ); 

