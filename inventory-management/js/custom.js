  $(document).ready(function(){

    $(document).on('click', '.increment', function () {
                  
      var $quantityInput = (this).closest('.qtyBox').find('.qty');
      var prodCode = (this).closest('.qtyBox').find('.prodCode');
    
      var currentValue = parseInt($quantityInput.val());
      if(!NaN(currentValue)){
        var qtyVal = currentValue + 1;
        $quantityInput.val(qtyVal);
      }
    
    });
    // increment decrement ends here
    $(document).on('click', '.decrement', function () {
      
      var $quantityInput = (this).closest('.qtyBox').find('.qty');
      var prodCode = (this).closest('.qtyBox').find('.prodCode');
    
      var currentValue = parseInt($quantityInput.val());
      if(!NaN(currentValue) && currentValue > 1){
        var qtyVal = currentValue - 1;
        $quantityInput.val(qtyVal);
      }
    
    });
  // quantity decrement ends here
});
