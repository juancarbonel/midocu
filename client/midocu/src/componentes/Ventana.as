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
package componentes
{
	import flash.display.DisplayObject;
	import flash.events.Event;
	
	import mx.containers.TitleWindow;
	import mx.managers.PopUpManager;

	public class Ventana extends TitleWindow
	{
		private var _padre:DisplayObject;
		private var _titulo;
		
		public function Ventana()
		{
			super();
			this.init();
		}
		
		
	
		public function init():void{
			this.addEventListener(Event.CLOSE,this.cerrar);
			this.showCloseButton=true;
		}
		
		public function mostrar():void{
			PopUpManager.addPopUp(this,this._padre);
		}
		
		public function cerrar(e:Event):void{
			PopUpManager.removePopUp(this);
		}
		
		public function set padre(padre:DisplayObject):void{
			this._padre=padre;
		}
		
		public function set titulo(nuevoTitulo:String){
			this._titulo = nuevoTitulo;
			super.title=nuevoTitulo;
		}
		
		
		
	}
}