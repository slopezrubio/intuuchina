var object = (function() {


    return {
        arrayValues: function(obj, value) {
            let objArray = [];

            for(let i = 0; i < obj.length; i++) {
                objArray.push(obj[i][value])
            }

            return objArray;
        }
    }
}());

export default object;