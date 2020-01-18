import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Persona } from '../../models/persona.model';


@Injectable({
  providedIn: 'root'
})
export class PersonaService {

  httpOptions = { };

  constructor( private http: HttpClient) {
    this.httpOptions = {
      headers: new HttpHeaders({
        'Content-Type':  'application/json',
        'Authorization': 'Bearer P5fFkzf8VQb64WDgRA03biUSCAieDjNrDvvNNqGA9Lw1iihzEJOJVGJRSz8A'
      })
    };
  }

  getAllPersonas() {
    console.log(this.httpOptions);
    return this.http.get<Persona[]>('http://kioskostestapi.local/api/public/index.php/api/persona/todos', this.httpOptions);
  }

  getPersona(id: string) {
    return this.http.get<Persona>(`http://kioskostestapi.local/api/public/index.php/api/persona/obtener/${id}`, this.httpOptions);
  }
}
