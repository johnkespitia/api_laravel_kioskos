import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PersonasRoutingModule } from './personas-routing.module';
import { PersonaComponent } from './components/persona/persona.component';
import { PersonaDetalleComponent } from './components/persona-detalle/persona-detalle.component';
import { MaterialModule } from '../material/material.module';


@NgModule({
  declarations: [
    PersonaComponent,
    PersonaDetalleComponent
  ],
  imports: [
    CommonModule,
    PersonasRoutingModule,
    MaterialModule
  ],exports:[
    MaterialModule
  ]

})
export class PersonasModule { }
