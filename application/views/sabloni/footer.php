<footer class="page-footer font-small blue pt-4 mt-4">
    <div class="footer-copyright py-3 text-center">
        © 2018 Copyright: MIMI
    </div>

    <script type="text/javascript">
    // DOM element where the Timeline will be attached
    var container = document.getElementById('visualization');
    
    // Create a DataSet (allows two way data-binding)
    var items = new vis.DataSet([
        {id: 1, content: 'item 1', start: '2014-04-20'},
        {id: 2, content: 'item 2', start: '2014-04-14'},
        {id: 3, content: 'item 3', start: '2014-04-18'},
        {id: 4, content: 'item 4', start: '2014-04-16', end: '2014-04-19'},
        {id: 5, content: 'item 5', start: '2014-04-25'},
        {id: 6, content: 'item 6', start: '2014-04-27', type: 'point'}
    ]);

    // Configuration for the Timeline
    var options = {};

    // Create a Timeline
    var timeline = new vis.Timeline(container, items, options);
    </script>

    
</footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    </div>
</body>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    
</html>
