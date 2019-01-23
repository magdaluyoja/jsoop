<!DOCTYPE html>
<html>
<head>
	<title>Proto Inheritance</title>
</head>
<body>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		;(function(){
			const extend = function(destination, source) {
			  	for (var k in source) {
				    if (source.hasOwnProperty(k)) {
				      destination[k] = source[k];
				    }
				}
				return destination; 
			}
			window.extend = extend;
		})();
		;(function(window, $){
			const A = function(){
				return new A.init();
			}
			A.init = function(){
				this.aprop = "Hello";
			}
			A.prototype = {
				a1:function(){
					alert("A1");
				}
			}
			A.init.prototype  = A.prototype;
			return window.$A = A;
		})(window, $);


		;(function(window, $){
			const B = function(){
				return new B.init();
			}
			B.init = function(){
				$A.init.call(this);
				this.bprop = "Hi";
			}
			B.prototype = {
				b1:function(){
					alert("B1");
				}
			}
			
			
			B.init.prototype  = $.extend(B.prototype, $A.init.prototype);
			// B.init.prototype  = B.prototype;
			// extend(B.init.prototype, $A.prototype);

			
			return window.$B = B;
		})(window, $);

		;(function(window, $){
			const C = function(){
				return new C.init();
			}
			C.init = function(){
				$B.init.call(this);
			}
			C.prototype = {
				c1:function(){
					alert("C1");
				}
			}
			
			C.init.prototype  = $.extend(C.prototype, $B.init.prototype);
			// C.init.prototype  = C.prototype;
			// extend(C.init.prototype, $B.prototype);

			
			return window.$C = C;
		})(window, $);

		var b = $C();
		console.log(b);
		b.a1();
		b.b1();
		alert(b.aprop);
		alert(b.bprop);


	</script>
</body>
</html>