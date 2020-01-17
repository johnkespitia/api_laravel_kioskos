import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PersonaComponent } from './components/persona/persona.component';
import { PersonaDetalleComponent } from './components/persona-detalle/persona-detalle.component';


const routes: Routes = [
  {
    path: '',
    redirectTo: 'list',
    pathMatch: 'full'
  },
  {
    path: 'list',
    component: PersonaComponent
  },
  {
    path: 'persona/:id',
    component: PersonaDetalleComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PersonasRoutingModule { }
