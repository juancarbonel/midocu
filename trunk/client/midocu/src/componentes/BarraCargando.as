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
	

	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.ProgressEvent;
	import flash.text.TextField;
	
	import mx.controls.TextArea;
	import mx.events.*;
	import mx.preloaders.DownloadProgressBar;

	public class BarraCargando extends DownloadProgressBar {

       
    
        public function BarraCargando() 
        {
            super(); 
            this.label = "cargando";
          	this.showLabel = true;      
          	var letra:TextField=new TextField();
          	letra.text="una palarvra";
          	this.addChild(letra);
          	
          	
          
        }
    
        override public function set preloader( preloader:Sprite ):void 
        {         	      
            preloader.addEventListener( ProgressEvent.PROGRESS , SWFDownloadProgress );    
            preloader.addEventListener( Event.COMPLETE , SWFDownloadComplete );
            preloader.addEventListener( FlexEvent.INIT_PROGRESS , FlexInitProgress );
            preloader.addEventListener( FlexEvent.INIT_COMPLETE , FlexInitComplete );
        }
    
        private function SWFDownloadProgress( event:ProgressEvent ):void {}
    
        private function SWFDownloadComplete( event:Event ):void {}
    
        private function FlexInitProgress( event:Event ):void {}
    
        private function FlexInitComplete( event:Event ):void 
        {      
        	
            dispatchEvent( new Event( Event.COMPLETE ) );
        }
        
 	}
}