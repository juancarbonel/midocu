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
package libs
{
	public class Validador
	{
		public function Validador()
		{
		}
		
		static public function isEmail(string:String):Boolean{
				var regExp:RegExp = /^([\w\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;  
  				var result:Array = regExp.exec(string);  
   
  				//Compruebo que exista una direccón de mail correcta en @string  
  				if(!regExp.test(string))  
   					return false;  
   
  				//Compruebo que en el resultado no haya delante otros carácteres  
  				if(result.index != 0)  
   					return false;  
   
  				//Compruebo que la dirección de mail encontrada sea igual a @string  
  				if( ( String(result[0]).length != string.length ) )  
   					return false;  
    
	  	return true;  
		
		}
		

	}
}