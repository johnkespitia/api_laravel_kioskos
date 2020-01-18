import { Component, OnInit } from '@angular/core';
import { Persona } from 'src/app/core/models/persona.model';
import { PersonaService } from 'src/app/core/services/personas/persona.service';

@Component({
  selector: 'app-persona',
  templateUrl: './persona.component.html',
  styleUrls: ['./persona.component.scss']
})
export class PersonaComponent implements OnInit {

  personas: Persona[] = [
    {
      id: '1',
      numero_documento: '12123213123',
      primer_nombre: 'Mario',
      segundo_nombre: 'Camilo',
      primer_apellido: 'Enzeo',
      segundo_apellido: 'loaiza',
      tipo_documento: 'Tarjeta'
    }
  ];

  constructor(
    private personaService: PersonaService
  ) { }

  ngOnInit() {
    this.fetchPersonas();
  }

  fetchPersonas() {
    this.personaService.getAllPersonas().subscribe(
      personas => {
        console.log(personas);
      }
    );
  }

}
