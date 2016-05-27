var inst = function () {
    var loadAllElements = function (pk) {
        $("#tree").fancytree({
          // Initial node data that sets 'lazy' flag on some leaf nodes
          source: {
            url: "/institutions/getFolders",
            cache: false
          },
          // Called when a lazy node is expanded for the first time:
          lazyLoad: function(event, data){
              var node = data.node;
              // Load child nodes via ajax GET /getTreeData?mode=children&parent=1234
              data.result = {
                url: "/institutions/getContracts",
                data: {mode: "children", parent: node.key},
                cache: false
              };
          },
            activate: function (event, data) {
                var node = data.node;
                // Use <a> href and target attributes to load the content:
                console.log(node);
            }          
        });
    };
    return {
        //main function to initiate template pages
        init: function (pk) {
            loadAllElements(pk);
        }
    };
}();