<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
crossorigin="anonymous"
></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="{{asset('assets/public/main.js')}}"></script>
<script rel="stylesheet" src="{{asset('assets/node_modules/izitoast/dist/js/iziToast.min.js')}}"></script>
<script>
      iziToast.settings({
    timeout: 3000,
    icon: 'material-icons',
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    closeOnClick: true,
    position:'topRight'
  });

  var baseUrl = '{{ url('/') }}';
</script>
