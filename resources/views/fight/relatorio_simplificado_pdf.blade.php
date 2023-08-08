
<p><strong>Fighter Nº1</strong>: {{ $fight->fighter1->nome }}</p>
<p><strong>Fighter Nº2</strong>: {{ $fight->fighter2->nome }}</p>
<p><strong>Vencedor</strong>: {{ $fight->vencedor == $fight->fighter1_id ? $fight->fighter1->nome : $fight->fighter2->nome }} </p>
