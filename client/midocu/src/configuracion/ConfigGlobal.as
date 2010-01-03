/****************************************************************
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
 * **************************************************************/
package configuracion
{
	import mx.core.Application;
	
	public class ConfigGlobal
	{
		
		/*
		* Retorna la direccion url, que es base de nuestra aplicacion 
		*/
		public static function getUrlGlobal():String{
			/*
			* ejemplo http://localhost/tramdo_cumentario
			*/
			var output:String=Application.application.parameters.site_url;	
			return output;
		}
		/*
		* retorna si estamos ejecutando en modo depurador ( TRUE o FALSE)
		*/
		public static function getDebug():Boolean{
			var output:String=Application.application.parameters.debug;	
			return output;
		}

	}
}