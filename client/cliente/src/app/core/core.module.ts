import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PersonaService } from './services/personas/persona.service';



@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ],
  providers: [
    PersonaService
  ]
})
export class CoreModule { }
